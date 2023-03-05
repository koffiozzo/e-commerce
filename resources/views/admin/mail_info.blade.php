<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
    @include('admin.css')

  <style type="text/css">
  
   #corners {
        border-radius: 25px;
        padding: 2px;
        
      }
    label
     {
          display:inline-block;
          width: 200px;
          font-size:15px;
          font-weight:bold;
     }
  
  </style>

  </head>
  <body>
    <div class="container-scroller">

      @include('admin.sidebar')

      @include('admin.header')

      <div class="main-panel">
          <div class="content-wrapper">

         <h1 style="text-align:center; font-size:25px;">Envoyer un e-mail à : {{$order->email}}</h1>

          <form action="{{url('send_user_email',$order->id)}}" method="POST">

            @csrf

              <div  style="padding-left: 35%; padding-top: 35px;">
                   <label>Email de salutation :</label>
                   <input style="color:black;" type="text" id="corners" name="greeting">
              </div>

               <div  style="padding-left: 35%; padding-top: 35px;">
                   <label>Premier email :</label>
                   <input style="color:black;" type="text" id="corners" name="firstline">
              </div>

              <div  style="padding-left: 35%; padding-top: 35px;">
                   <label>Corps de l'e-mail :</label>
                   <input style="color:black;" type="text" id="corners" name="body">
              </div>

              <div  style="padding-left: 35%; padding-top: 35px;">
                   <label>Nom du bouton e-mail  :</label>
                   <input style="color:black;" type="text" id="corners" name="button">
              </div>

              <div  style="padding-left: 35%; padding-top: 35px;">
                   <label>Email url  :</label>
                   <input style="color:black;" type="text" id="corners" name="url">
              </div>

              <div  style="padding-left: 35%; padding-top: 35px;">
                   <label>Dernier email  :</label>
                   <input style="color:black;" type="text" id="corners" name="lastline">
              </div>

              <div style="padding-left: 35%; padding-top: 35px;">
                   
                   <input type="submit" value="Envoyer l'email" class="btn btn-primary">
              </div>
        </form>



          </div>
      </div>
        
     
    
      @include('admin.script')
  </body>
</html>