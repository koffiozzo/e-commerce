<!DOCTYPE html>
<html lang="en">
  <head>
  
    @include('admin.css')

    <style type="text/css">

    .div_center
    {
        text-align: center;
        padding: 30px;
    }
    .font-size
    {
      font-size: 30px;
      padding-bottom: 30px;
    }
    .text_color
    {
        color: black;
        width:340px;
        height:35px;
    }
    label
    {
        display: inline-block;
        width: 200px;
    }
    .div_design
    {
        padding-bottom: 15px;
    }
    
    </style>
  </head>
  <body>
    <div class="container-scroller">

      @include('admin.sidebar')

      @include('admin.header')
        
      <div class="main-panel">
          <div class="content-wrapper">

          
              @if(session()->has('message'))

               <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
           
                 {{session()->get('message')}}

               </div>
              
              @endif

            <div class="div_center">
               <h1 class="font-size">MODIFIER LE PRODUIT</h1>

               <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">

               @csrf

               <div class="div_design">

               <label>Nom du produit :</label>
               <input class="text_color" type="text" name="title"  value="{{$product->title}}" placeholder="Entrer le titre du Produit" required="">

               </div>

                  <div class="div_design">

               <label>Description du produit :</label>
               <input class="text_color" type="text" value="{{$product->description}}" name="description" placeholder="Entrer la description du Produit" required="">
               
               </div>

                <div class="div_design">

               <label>Prix du produit :</label>
               <input class="text_color" type="number" name="price" value="{{$product->price}}" placeholder="Entrer le prix du Produit" required="">
               
               </div>

               <div class="div_design">

               <label>Prix de Remise :</label>
               <input class="text_color" type="number" min="0" name="disc_price" value="{{$product->discount_price}}" placeholder="Entrer l'id du compte">
               
               </div>

                <div class="div_design">

               <label>Quantité du produit :</label>
               <input class="text_color" type="number"  min="0" name="quantity" value="{{$product->quantity}}" placeholder="Entrer la quantité du Produit" required="">
               
               </div>

                <div class="div_design">

                <label>Catégorie du Produit</label>
                  <select class="text_color" name="category"  required="">
                       <option value="{{$product->category}}" selected="">{{$product->category}}</option>

                       @foreach ($category as $category )
                      
                         <option value="{{$category->category_name}}">{{$category->category_name}}</option>

                      @endforeach

                  </select>
               </div>

             <div class="div_design" >

               <label>Image actuelle du produit :</label>
               <img style="margin:auto" height="50" width="50" src="/products/{{$product->Image}}">
               
            </div>

             <div class="div_design" >

               <label>Changer l'image du Produit:</label>
               <input type="file" name="image" >
               
            </div>

              <div class="div_design">

               <input type="submit" value="Ajouter Produit" class="btn btn-primary">
                
             </div>
             </form>

          </div>
      </div>

    
      @include('admin.script')
  </body>
</html>