<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;





class AdminController extends Controller
{
    public function view_category()
    {
        if(Auth::id())
        {
            $data = Category::all();
            return view('admin.category', compact('data'));
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function add_category(Request $request)
    {
        $data=new Category;
        $data->category_name=$request->category;
        $data->save();

        return redirect()->back()->with('message','catégorie ajouter avec succès');
    }

    public function delete_category($id)
    {
        $data=Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Catégorie supprimer avec succès! !');

    }

    public function view_product()
    {
        $category=category::all();
        return view('admin.product',compact('category'));
    }

    public function add_product(Request $request)
    {
      $product=new product;
      $product->title=$request->title;
      $product->description=$request->description;
      $product->price=$request->price;
      $product->quantity=$request->quantity;
      $product->discount_price=$request->disc_price;
      $product->category=$request->category;

      
      $image=$request->image;
      $imagename=time().'.'.$image->getClientOriginalExtension();
      $request->image->move('product',$imagename);
      $product->image=$imagename;
      $product->save();
      return redirect()->back()->with('message', 'Produit ajouter avec succès! !');
    }

    public function show_product()
    {
        $product=product::all();
        return view('admin.show_product',compact('product'));
    }
       
    public function delete_product($id)
    {
        $product=product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Produit supprimer avec succès !');
    }

    public function update_product($id)
    {
        $product=product::find($id);
        $category=category::all();
        return view('admin.update_product',compact('product','category'));
    }

    public function update_product_confirm(Request $request, $id)
    {
        if(Auth::id())
        {
            $product=product::find($id);

        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->discount_price=$request->disc_price;
        $product->category=$request->category;
        $product->quantity=$request->quantity;

        $image=$request->image;
        if($image)
        {

             $imagename=time().'.'.$image->getClientOriginalExtension();
             $request->image->move('product',$imagename);
             $product->image=$imagename;

        }
             $product->save();
             return redirect()->back()->with('message', 'Produit modifier avec succès !');
             
        }
        else
        {
            return redirect('login');
        }
       
       
    }

    public function order()
    {
        $order=order::all();
        return view('admin.order',compact('order'));
    }

    public function delivered($id)
    {
        $order=order::find($id);
        $order->delivery_statut="Livré";
        $order->payment_status="Payé";
        $order->save();

        return redirect()->back();

    }

    public function print_pdf($id)
    {
        $order=order::find($id);
        $pdf=PDF::loadView('admin.pdf',compact('order'));
         return $pdf->download('Commande_détails.pdf');
    }

    public function send_mail($id)
    {
        $order=order::find($id);
        return view('admin.mail_info',compact('order'));
    }

    public function send_user_email(Request $request,$id)
    {
        $order=order::find($id);

        $details = [
            'greeting' =>$request->greeting,

            'firstline' =>$request->firstline,

            'body' =>$request->body,

            'button' =>$request->button,

            'url' =>$request->url,

            'lastline' =>$request->lastline,
        ];

        Notification::send($order,new SendEmailNotification($details));

        return redirect()->back();
    }

    public function searchdata(Request $request)
    {
        $searchText=$request->search;
        $order=order::where('name','LIKE',"%searchText%")->orWhere('phone','LIKE',"%searchText%")->orWhere('product_title','LIKE',"%searchText%")->get();

        return view('admin.order',compact('order'));
    }
}

