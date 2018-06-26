<?php require_once("../../resources/config.php") ?>
<?php require_once(TEMPLATE_BACK . DS . "header.php")?>

<?php 

/* Koden forneden er en sikkerhedsmekanisme. Hvis superglobal variablen
$_SESSION ikke er gemt med værdien "username", så kan man ikke tilgå
admin-panelet og bliver derfor omdirigeret til forsiden. */

if(!isset($_SESSION['username'])) {

    redirect("../../public"); 

}

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Koden forneden bliver brugt til at sikre sig, at brugerne
                er på den rigtige sti, før at de kan få adgang til admin-panelet. -->
              <?php 

              if($_SERVER['REQUEST_URI'] == "/garnopskrifter/public/admin/" 
              || $_SERVER['REQUEST_URI'] == "/garnopskrifter/public/admin/index.php") 
              {
                   
                  include(TEMPLATE_BACK . DS . "reports.php");

              }
              
              /* Koden forneden bliver brugt til at sikre sig, at værdierne for de for
              skellige sider som fx "orders", bliver opsnappet i superglobal variablen $_GET, før der bliver
              givet adgang til de respektive sider. Det kunne fx være at man vil ind på products.php. For
              det bliver man nødt til at sende en GET-request, ved fx at trykke på dette link:
              index.php?products */

              if(isset($_GET['orders'])) {
                      
                  include(TEMPLATE_BACK . DS . "orders.php");

              }

              if(isset($_GET['products'])) {
                      
                include(TEMPLATE_BACK . DS . "products.php");

            }

            if(isset($_GET['add_product'])) {
                      
                include(TEMPLATE_BACK . DS . "add_product.php");

            }

            if(isset($_GET['edit_product'])) {
                      
                include(TEMPLATE_BACK . DS . "edit_product.php");

            }

            if(isset($_GET['categories'])) {
                      
                include(TEMPLATE_BACK . DS . "categories.php");

            }

            if(isset($_GET['users'])) {
                      
                include(TEMPLATE_BACK . DS . "users.php");

            }

            if(isset($_GET['add_user'])) {
                      
                include(TEMPLATE_BACK . DS . "add_user.php");

            }
                
            if(isset($_GET['edit_user'])) {
                      
                include(TEMPLATE_BACK . DS . "edit_user.php");

            }

            if(isset($_GET['reports'])) {
                      
                include(TEMPLATE_BACK . DS . "reports.php");

            }


               ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php require_once(TEMPLATE_BACK . DS . "footer.php")?>

