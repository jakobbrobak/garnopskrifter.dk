<?php require_once("../resources/config.php") ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php")?>

    <!-- Siden bliver brugt til at vise alle produkterne for en specifik kategori 
         ved hjælp af get_products_by_categories() funktionen. -->


    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>Velkommen til Garnopskrifter.dk!</h1>
            <p>Vi er stedet for køb af de bedste garnopskrifter til alt lige fra hækling af huer til strik af varme slumretæpper :)</p>
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Sortiment</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            
            <?php get_products_by_categories(); ?>
            
        

        </div>
        <!-- /.row -->
       

    </div>
    <!-- /.container -->

  <?php require_once(TEMPLATE_FRONT . DS . "footer.php")?>
