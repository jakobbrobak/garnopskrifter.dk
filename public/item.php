<?php require_once("../resources/config.php") ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php")?>



    <!-- Denne side indeholder data for et specifikt produkt. Altså selve produktsiden. 
    Det gør den ved hjælp af get_product_item() funktionen. -->

<div class="container">

       <!-- Side Navigation -->

           <?php require_once(TEMPLATE_FRONT . DS . "side_nav.php")?>
           
           <?php get_product_item(); ?>

</div>


   
    <!-- /.container -->
<?php require_once(TEMPLATE_FRONT . DS . "footer.php")?>
  
