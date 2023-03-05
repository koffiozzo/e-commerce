<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
   <style type="text/css">
   
   .title_deg
   {
    text-align:center;
    font-size:25px;
    font-weight: bold;
    padding-bottom: 40px;
    
   }

.table_deg
{
    border: 1px solid white;
    width:100%;
    margin: auto;
    text-align:center;
}

.th_deg
{
    background: skyblue;
}

.img_deg
{
    width:50px;
    height:50px;
}
 #corners {
        border-radius: 25px;
        padding: 5px;
        
      }
   
   </style>

  </head>
  <body>
    <div class="container-scroller">

      @include('admin.sidebar')

      @include('admin.header')
        
    <div class="main-panel">
          <div class="content-wrapper">

          <h1 class="title_deg">TOUS LES COMMANDES</h1>

          <div style="padding-left: 400px; padding-bottom:30px">
           
           @csrf
          
             <form action="{{url('search')}}" method="get">
             
              <input id="corners" style="color:black;" type="text" name="search" placeholder="Rechercher...">
              <input type="submit" value="Rechercher" class="btn btn-outline-primary">

            </form>
          
          </div>

          <table class="table_deg">
          
              <tr class="th_deg">
                  <th style="padding: 10px;">Nom</th>
                  <th style="padding: 10px;">Email</th>
                  <th style="padding: 10px;">Adresse</th>
                  <th style="padding: 10px;">Téléphone</th>
                  <th style="padding: 10px;">Nom Produit</th>
                  <th style="padding: 10px;">Quantité</th>
                  <th style="padding: 10px;">Prix</th>
                  <th style="padding: 10px;">Statut de paiement</th>
                  <th style="padding: 10px;">statut de livraison</th>
                  <th style="padding: 10px;">Image</th>
                  <th style="padding: 10px;">Livré</th>
                  <th style="padding: 10px;">Télécharger PDF</th>
                  <th style="padding: 10px;">Envoyé mail</th>
                  
              </tr>


              @forelse ($order as $order )

                  <tr>
                  <td>{{$order->name}}</td>
                  <td>{{$order->email}}</td>
                  <td>{{$order->adress}}</td>
                  <td>{{$order->phone}}</td>
                  <td>{{$order->product_title}}</td>
                  <td>{{$order->quantity}}</td>
                  <td>{{$order->price}}</td>
                  <td>{{$order->payment_status}}</td>
                  <td>{{$order->delivery_statut}}</td>
                  <td>
                     <img  class="img_deg" src="/products/{{$order->Image}}">
                  </td>
                  
                  <td>
                  @if ($order->delivery_statut=='En traitement')
                 
                     <a class="btn btn-primary" href="{{url('delivered',$order->id)}}" onclick="return confirm('Vous êtes sûr que ce Produit est livré?')">Livré</a>

                  @else
                     <p style="color:green">Livré</p>


                  @endif
                  </td>

                  <td>
                            <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary" >PDF</a>
                  </td>

                  <td>
                            <a href="{{url('send_mail',$order->id)}}" class="btn btn-info" >Mail</a>
                  </td>
                  
                  
              </tr>

              @empty

               <div>
                    <p>Aucune donnée disponible</p>
               </div>

             @endforelse
          
          </table>

          </div>
    </div>      
    
      @include('admin.script')
  </body>
</html>