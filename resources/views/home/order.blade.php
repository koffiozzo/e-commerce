<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

      <style type="text/css">
      
      .center
      {
         margin: auto;
         width: 70%;
         padding: 30px;
         text-align: center;
      }
      table,th,td
      {
         border: 1px solid black;
      }
      
      .th_deg
      {
         padding:10px;
         background-color: skyblue;
         font-size: 20px;
         font-weight: bold;
      }
      </style>
   </head>
   <body>
      <div class="hero_area">
         
         @include('home.header')

         <div class="center">
            <table>
                 <tr>
                     <th class="th_deg">Nom Produit</th>
                     <th class="th_deg">Quantité</th>
                     <th class="th_deg">Prix</th>
                     <th class="th_deg">Statut du Paiement</th>
                     <th class="th_deg">Statut de Livraison</th>
                     <th class="th_deg">Image</th>
                     <th class="th_deg">Supprimer Commande</th>
                 </tr>
                  @foreach ($order as $order)
                     
                 <tr>
                     <td>{{$order->product_title}}</td>
                     <td>{{$order->quantity}}</td>
                     <td>${{$order->price}}</td>
                     <td>{{$order->payment_status}}</td>
                     <td>{{$order->delivery_statut}}</td>
                     <td>
                         <img height="100" width="150" src="products/{{$order->Image}}">
                     </td>

                     <td>

                     @if ($order->delivery_statut=='traitement')
                        <a onclick="Confirm('Voulez vous vraiment supprimer la commande ?')" class="btn btn-danger" href="{{url('cancel_order',$order->id)}}">Supprimer</a>

                     @else
                         <p style="color:blue;">Impossible</p>   
                     @endif

                     </td>
                 </tr>
                  @endforeach
            </table>
         </div>
         
      </div>  
      
      
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