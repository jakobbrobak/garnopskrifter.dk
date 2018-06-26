<?php require_once("../resources/config.php") ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php")?>
  
   <!-- Denne side er en tak side, som kunderne bliver overført til, efter at de har betalt for et
   produkt på paypal. Vi får dermed mulighed for at modtage en status fra paypal over transaktionen
   ved hjælp af GET-parametrene. Dette håndtere process_transaction() funktionen. -->
   
   <?php

            process_transaction();

    ?>
    
    <div class="container">
        

     <h1 class="text-center ">Tak for dit køb!</h1>


    </div>
    <!-- /.container -->

<?php require_once(TEMPLATE_FRONT . DS . "footer.php")?>
