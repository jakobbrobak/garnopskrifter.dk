<?php require_once("../resources/config.php") ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php")?>



    <!-- Dette er startsiden for potentielle købere. Her bliver der vist produkter fra get_products() funktionen. -->

    <div class="container">

        <div class="row">

          <!-- Categories here -->
            
            <?php require_once(TEMPLATE_FRONT . DS . "side_nav.php")?>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        
                    </div>

                </div> 

                <div class="row">
                 
                   <?php get_products(); ?>

                </div>

            </div>

        </div> <!-- row ends here -->

    </div>
    <!-- /.container -->
<?php require_once(TEMPLATE_FRONT . DS . "footer.php")?>
