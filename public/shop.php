<?php require_once("../resources/config.php") ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php")?>

    <!-- Dette er selve shop-siden, hvor man får alle produkterne fremvist ved hjælp af get_products_in_shop_page() 
    funktionen. -->

    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>Velkommen til Shoppen!</h1>
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

            
            <?php get_products_in_shop_page(); ?>
            
        

        </div>
        <!-- /.row -->

       

    </div>
    <!-- /.container -->

  <?php require_once(TEMPLATE_FRONT . DS . "footer.php")?>
