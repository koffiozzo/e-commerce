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
    #corners {
        border-radius: 25px;
        padding: 10px;
        
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
               <h1 class="font-size">AJOUTER PRODUIT</h1>

               <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">

               @csrf

               <div class="div_design">

               <label style="text-align: right;">Nom du produit :</label>
               <input id="corners"  class="text_color" type="text" name="title" placeholder="Entrer le nom du Produit" required="">

               </div>

                  <div class="div_design">

               <label style="text-align: right;">Description du produit :</label>
               <input id="corners" class="text_color" type="text" name="description" placeholder="Entrer la description du Produit" required="">
               
               </div>

                <div class="div_design">

               <label style="text-align: right;">Prix du produit :</label>
               <input id="corners" class="text_color" type="number" name="price" placeholder="Entrer le prix du Produit" required="">
               
               </div>

               <div class="div_design">

               <label style="text-align: right;">Prix Promo :</label>
               <input id="corners" class="text_color" type="number" min="0" name="disc_price" placeholder="Entrer l'id du compte">
               
               </div>

                <div class="div_design">

               <label style="text-align: right;">Quantité du produit :</label>
               <input id="corners" class="text_color" id="corners" type="number"  min="0" name="quantity" placeholder="Entrer la quantité du Produit" required="">
               
               </div>

                <div class="div_design">

                <label style="text-align: right;">Catégorie du Produit :</label>
                  <select  class="text_color" name="category" required="">
                  <option  value="" selected="">Ajouter la catégorie ici</option>

                  @foreach ($category as $category )
                      
                   <option value="{{$category->category_name}}">{{$category->category_name}}</option>

                 @endforeach
                  </select>
               </div>

             <div class="div_design" >

               <label style="text-align: right;">Image du Produit :</label>
               <input type="file" name="image" required="">
               
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