<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

     <style type="text/css">
     
        .center
        {
            margin: auto;
            width: 100%;
            border: 2px  white;
            text-align:center;
            margin-top: 30px;
        }
        .font-size
        {
            text-align: center;
            font-size: 30px;
            padding-top: 20px
        }
        .img_size
        {
            width: 50px;
            height: 50px;
        }
        .th_color
        {
            background: blue;
        }
        .th_deg
        {
            padding:18px;
            
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

          <h2 class="font-size" >LISTE DES PRODUITS</h2>
            

          <table class="center">
          
              <tr class="th_color">
                 <th class="th_deg">Nom Produit</th>
                 <th class="th_deg">Description</th>
                 <th class="th_deg">Quantité</th>
                 <th class="th_deg">Catégorie</th>
                 <th class="th_deg">Prix</th>
                 <th class="th_deg">Prix Promo</th>
                 <th class="th_deg">Image Produit</th>
                 <th class="th_deg">Supprimer</th>
                 <th class="th_deg">Editer</th>
              </tr>

              @foreach ($product as $product )
                  
                <tr>
                  <td>{{$product->title}}</td>
                  <td>{{$product->description}}</td>
                  <td>{{$product->quantity}}</td>
                  <td>{{$product->category}}</td>
                  <td>{{$product->price}}</td>
                  <td>{{$product->discount_price}}</td>
                  <td>
                     <img  class="img_size" src="/products/{{$product->Image}}">
                  </td>

                  <td>
                       <a class="btn btn-danger" onclick="return confirm('Voulez vous vraiment supprimer ?')" href="{{url('delete_product',$product->id)}}">Supprimer</a>
                  </td>
                  <td>
                       <a class="btn btn-success" href="{{url('update_product',$product->id)}}">Editer</a>
                  </td>
                  
              </tr>

             @endforeach
          </table>

          </div>
      </div>
    
      @include('admin.script')
  </body>
</html>