<?php require_once("../resources/config.php") ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php")?>
   
    <!-- Siden bliver brugt til at vise de ting man har i kurven, og giver samtidig mulighed for at købe
         produkterne ved hjælp af cart() funktionen.  -->
         
    <div class="container">
        

<!-- /.row --> 

<div class="row">
      <h4 class="text-center bg-danger"><?php display_message();?></h4>
      <h1>Kurv</h1>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="business" value="jakobbrobak-facilitator@gmail.com">
  <input type="hidden" name="currency_code" value="DKK">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Produkt</th>
           <th>Pris</th>
           <th>Antal</th>
           <th>I alt</th>
     
          </tr>
        </thead>
        <tbody>
          <?php cart(); ?>
        </tbody>
    </table>
    <?php echo show_paypal(); ?>
</form>
 

<!--  ***********CART TOTALS*************-->

<!-- PHP-koden forneden bliver brugt til dynamisk at kalkulere totalprisen samt antallet af produkter for købet via.
 de værdier som er placeret i $_SESSION superglobal variablerne.-->
            
<div class="col-xs-4 pull-right ">
<h2>Total</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Produkter:</th>
<td><span class="amount">
    <?php
    
     echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = " 0";
    
    ?>
</span>
</td>
</tr>
<tr class="shipping">
<th>Fragt</th>
<td>Gratis</td>
</tr>

<tr class="order-total">
<th>Totalpris</th>
<td><strong><span class="amount">
    <?php
    
     echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0";
    
    ?>
    DKK</span></strong> 
</td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->



    </div>
    <!-- /.container -->

<?php require_once(TEMPLATE_FRONT . DS . "footer.php")?>
