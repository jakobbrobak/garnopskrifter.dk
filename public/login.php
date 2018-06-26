<?php require_once("../resources/config.php") ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php")?>

    <!-- Dette er loginsiden for alle brugerne. Her bliver brugernavn og password verificeret. Man
    får en besked, hvis man indtaster noget forkert, og ellers bliver man videresendt til admin-panelet. -->

    <div class="container">

      <header>
            <h1 class="text-center">Login</h1>
            <h2 class="text-center bg-warning"><?php display_message(); ?></h2>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post">
               
               <?php login_user(); ?>
               
                <div class="form-group"><label for="">
                    Brugernavn<input type="text" name="username" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Adgangskode<input type="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" >
                </div>
            </form>
        </div>  
 

    </header>


        </div>

    <!-- /.container -->

    <?php require_once(TEMPLATE_FRONT . DS . "footer.php")?>
