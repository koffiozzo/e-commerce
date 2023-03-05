<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\remove_cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use RealRashid\SweetAlert\Facades\Alert;



use Session;
use Stripe;

class HomeController extends Controller
{


  public function index()
  {
    $product=product::paginate(3);
    $comments =comment::orderby('id','desc')->get();
    $reply=reply::all();
    return view('home.userpage',compact('product','comments','reply'));
  }

  
   public function redirect()
   {
    $usertype=Auth::user()->usertype; 
 
       if($usertype=='1')
         {
            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count();
            $order=order::all();
            $total_revenu=0;

            foreach($order as $order)
            {
              $total_revenu=$total_revenu + $order->price;
            }

           $total_delivered=order::where('delivery_statut','=','Livré')->get()->count();

           $total_payment=order::where('payment_status','=','Payé')->get()->count();

            return view('admin.home',compact('total_product','total_order','total_user','total_revenu','total_delivered','total_payment'));
         }

       else
         {
          $product=product::paginate(6);
          $comments=comment::orderby('id','desc')->get();
          $reply=reply::all();
          return view('home.userpage',compact('product','comments','reply'));
         }
   }


   public function product_detail($id)
   { 
    $product=product::find($id);
    return view('home.product_detail',compact('product'));
   }

   public function add_cart(Request $request, $id)
   {
    if(Auth::id())
    {
      $user=Auth::user();
      $userid=$user->id;
      $product=product::find($id);
      $product_exist_id=cart::where('Product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

      if($product_exist_id)
      {
        $cart=cart::find($product_exist_id)->first();
        $quantity=$cart->quantity;
        $cart->quantity=$quantity + $request->quantity;

        if($product->discount_price!=null)
        {
          $cart->price=$product->discount_price * $cart->quantity;
        }
        else
        {
          $cart->price=$product->price * $cart->quantity; 
        }

        $cart->save();
        Alert::success('Produit ajouter avec succes','Nous avons ajouté le produit au panier !');
        return redirect()->back();
      }
      else
      {
        $cart=new cart;
        $cart->name=$user->name;
        $cart->email=$user->email;
        $cart->phone=$user->phone;
        $cart->adress=$user->adress;
        $cart->User_id=$user->id;
  
        $cart->Product_title=$product->title;
  
        if($product->discount_price!=null)
        {
          $cart->price=$product->discount_price * $request->quantity;
        }
        else
        {
          $cart->price=$product->price * $request->quantity; 
        }
        
        $cart->Image=$product->Image;
        $cart->Product_id=$product->id;
        $cart->quantity=$request->quantity;
  
        $cart->save();
  
        return redirect()->back()->with('message', 'Produit ajouter avec succès !');
      }
     
    }
    else
    {
      return redirect('login');
    }
   }


   public function show_cart()
   {
    if(Auth::user())
    {
      $id=Auth::user()->id;
      $cart=cart::where('User_id','=',$id)->get();
      return view('home.show_cart',compact('cart'));
    }
    else
    {
        return redirect('login');
    }
     
   }


   public function remove_cart($id)
   {
    $cart=cart::find($id);
    $cart->delete();
    return redirect()->back();
   }

   
   public function cash_order()
   {
     $user=Auth::user();
     $userid=$user->id;
     
     $data=cart::where('User_id','=',$userid)->get();

     foreach($data as $data)
     {
        $order=new order;
        $order->name=$data->name;
        $order->email=$data->email;
        $order->phone=$data->phone;
        $order->adress=$data->adress;
        $order->User_id=$data->User_id;
        $order->product_title=$data->product_title;
        $order->price=$data->price;
        $order->quantity=$data->quantity;
        $order->Image=$data->Image;
        $order->product_id=$data->Product_id;

        $order->payment_status='Paiement à la livraison';
        $order->delivery_statut='En traitement';

        $order->save();

        $cart_id=$data->id;
        $cart=cart::find($cart_id);
        $cart->delete();
     }
     return redirect()->back()->with('message', 'nous avons reçu votre commande, nous vous contacterons bientôt !');
     
   }


   public function stripe($totalprice)
   {
    return view('home.stripe',compact('totalprice'));
   }


   public function stripePost(Request $request,$totalprice)
   {
    
       Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
   
       Stripe\Charge::create ([
               "amount" => $totalprice * 100,
               "currency" => "usd",
               "source" => $request->stripeToken,
               "description" => "Merci pour le paiement" 
       ]);


       $user=Auth::user();
     $userid=$user->id;
     
     $data=cart::where('User_id','=',$userid)->get();

     foreach($data as $data)
     {
        $order=new order;
        $order->name=$data->name;
        $order->email=$data->email;
        $order->phone=$data->phone;
        $order->adress=$data->adress;
        $order->User_id=$data->User_id;
        $order->product_title=$data->product_title;
        $order->price=$data->price;
        $order->quantity=$data->quantity;
        $order->Image=$data->Image;
        $order->product_id=$data->Product_id;

        $order->payment_status='Payer';
        $order->delivery_statut='En traitement';

        $order->save();

        $cart_id=$data->id;
        $cart=cart::find($cart_id);
        $cart->delete();
     }

     
       Session::flash('success', 'Paiement réussi!');
             
       return back();
   }


   public function show_order()
   {
        if(Auth::id())
        {
          $user=Auth::user();
          $userid=$user->id;

          $order=order::where('user_id','=',$userid)->get();
           return view('home.order',compact('order'));
        }
        else
        {
           return redirect('login');
        }
  }


  public function cancel_order($id)
  {
    $order=order::find($id);
    $order->delivery_statut='Vous avez annulé la commande';
    $order->save();

    return redirect()->back();
  }


  public function add_comment(Request $request)
  {
    if(Auth::id())
    {
      $comment=new comment;
      $comment->name=Auth::user()->name;
      $comment->user_id=Auth::user()->id;
      $comment->comment=$request->comment;

      $comment->save();
      return redirect()->back();
    }
    else
    {
      return redirect('login');
    }

  }


  public function add_reply(Request $request)
  {
    if(Auth::id())
    {
      $reply= new reply;
      $reply->name=Auth::user()->name;
      $reply->user_id=Auth::user()->id;
      $reply->comment_id=$request->commentId;
      $reply->reply=$request->reply;
      
      $reply->save();
      return redirect()->back();
    }  
    else
    {
       return redirect('login');
    }
 
  }


  public function product_search(Request $request)
  {
    $comments =comment::orderby('id','desc')->get();
    $reply=reply::all();
    $serach_text=$request->search;
    $product=product::where('title','LIKE',"%serach_text%")->orWhere('category','LIKE',"%serach_text%")->paginate(10);
    return view('home.userpage',compact('product','comments','reply'));
  }


  public function product()
  {
    $product=product::paginate(3);
    $comments =comment::orderby('id','desc')->get();
    $reply=reply::all();
    return view('home.all_product',compact('product','comments','reply'));
  }


  public function search_product(Request $request)
  {
    $comments =comment::orderby('id','desc')->get();
    $reply=reply::all();
    $serach_text=$request->search;
    $product=product::where('title','LIKE',"%serach_text%")->orWhere('category','LIKE',"%serach_text%")->paginate(10);
    return view('home.all_product',compact('product','comments','reply'));
  }
}