<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">

      .div_center
      {
        text-align: center;
        padding-top : 40px;

      }
      .h2_font
      {
        font-size: 40px;
        padding-bottom:40px;
      }
      .input_color
      {
        color: black;
        width:340px;
        height:35px;
        border-radius: 25px 0 0 25px;
        
      }
      .center
      {
        margin: auto;
        width: 60%;
        text-align: center;
        margin-top: 30px;
        border:1px solid white;
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
               <h2 class="h2_font">AJOUTER UNE CATEGORIE</h2>

               <form action="{{url('add_category')}}" method="POST">

               @csrf

                <input class="input_color" id="corners" type="text" name="category" placeholder="Entrer le nom de la catégorie">
               <input type="submit" class="btn btn-primary" name="submit" value="Ajouter catégorie">

               </form>

            </div>
            <table class="center">
              <tr>
                   <td>Nom de la catégorie</td>
                   <td>Action</td>
              </tr>

              @foreach ($data as $data)
             
               <tr>
                   <td>{{$data->category_name}}</td>
                   <td>
                   <a onclick="return confirm('Voulez vous vraiment supprimer ?')" class="btn btn-danger" href="{{url('delete_category',$data->id)}}">Supprimer</a>
                   </td>
              </tr>

              @endforeach
            </table>

          </div>
    </div>
    
      @include('admin.script')
  </body>
</html>