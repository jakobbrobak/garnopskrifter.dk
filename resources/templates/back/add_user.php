
<!--  Denne side bliver brugt til at tilføje brugere til siden ved hjælp af add_user() funktionen.  -->

<?php add_user(); ?>

  <h1 class="page-header">
      Tilføj bruger
  </h1>

<div class="col-md-6 user_image_box">
    
<span id="user_admin" class='fa fa-user fa-4x'></span>

</div>


<form action="" method="post">


  <div class="col-md-6">


     <div class="form-group">
      <label for="username">Brugernavn</label>
      <input type="text" name="username" class="form-control" >
         
     </div>


      <div class="form-group">
          <label for="email">Email</label>
      <input type="text" name="email" class="form-control"   >
         
     </div>


      <div class="form-group">
          <label for="password">Adgangskode</label>
      <input type="password" name="password" class="form-control"  >
         
     </div>

      <div class="form-group">

      <input type="submit" name="add_user" class="btn btn-primary pull-right" value="Tilføj bruger" >
         
     </div>


      
 
  </div>



</form>





    