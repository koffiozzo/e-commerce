<!DOCTYPE html>
<html>
   <head>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
      @include('home.css')

     <style type="text/css">

     .center
      {
        margin:auto;
        width: 50%;
        text-align:center;
        padding:30px;
      }
      table,th,td
      {
        
        border: 1px solid grey;
      }
      .th_deg
      {
        font-size: 20px;
        padding: 5px;
        background: skyblue;
      }
      .img_deg
      {
         height:100px;
         width: 100px;
      }
      .total_deg
      {
         font-size:20px;
         padding:40px;
      }
         
    </style>
   </head>

   <body>

   @include('sweetalert::alert')

      <div class="hero_area">
         
         @include('home.header')
             
      @if(session()->has('message'))

               <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
           
                 {{session()->get('message')}}

               </div>
              
     @endif

      <div class="center">
      
        <table>

           <tr>
               <th class="th_deg">Nom Produit</th>
               <th class="th_deg">Quantité produit</th>
               <th class="th_deg">Prix</th>
               <th class="th_deg">Image</th>
               <th class="th_deg">Action</th>
           </tr>
              
           <?php $totalprice=0;?>
           @foreach ($cart as $cart )
                
           <tr>
               <td>{{$cart->product_title}}</td>
               <td>{{$cart->quantity}}</td>
               <td>${{$cart->price}}</td>
               <td><img class="img_deg" src="/products/{{$cart->Image}}"></td>
               <td><a class="btn btn-danger" onclick="confirmation(event)" href="{{url('/remove_cart',$cart->id)}}">Supprimer</a></td>
           
           </tr>

           <?php $totalprice=$totalprice + $cart->price;?>

           @endforeach 
           
        
        </table>

        <div>
            <h1 class="total_deg">Prix Total : ${{$totalprice}}</h1>
        </div>

        <div>
            <h1 style="font-size : 25px; padding-bottom:15px;"></h1>
            <a href="{{url('cash_order')}}" class="btn btn-danger">Paiement à la livraison</a>

            <a href="{{url('/stripe',$totalprice)}}" class="btn btn-danger">Payer par carte</a>
        </div>

      </div>
      
    
     
      
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Soltution10Gital</a><br>
         
           
         </p>
      </div>

   <script>
     function confirmation(ev){
      ev.preventDefault();
      var urlToRedirect = ev.currentTarget.getAttribute('href')
      console.log(urlToRedirect);
      swal({
         title: "Êtes vous sûr de vouloir supprimer ce produit ?",
         text: "vous ne pourrez pas revenir en arrière",
         icon: "warning",
         buttons: true,
         dangerMode: true,
      })
      .then((willCancel) =>{
         if (willCancel) {
            window.location.href = urlToRedirect;
         }
        
      });
     }
   </script>

      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>