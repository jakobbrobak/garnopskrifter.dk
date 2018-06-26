
<!--Koden forneden bliver brugt til at ændre et eksisterende produkt. Det gør den
ved hjælp af update_product() funktionen. Derudover viser den værdierne af de
nuværende felter.--> 


<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Ændring af produkt

</h1>
<h4 class="bg-success text-center"><?php display_message(); ?></h4>
</div>
               


<form action="" method="post" enctype="multipart/form-data">

<?php  

if(isset($_GET['id'])) {

   $query = query("SELECT * FROM products WHERE product_id = " . 
   escape_string($_GET['id']));
   confirm($query);

   while($row = fetch_array($query)) {
        
    $image = display_image($row['product_image']);
 
    $product_title = escape_string($row['product_title']);
    $product_category_id = escape_string($row['product_category_id']);
    $product_price = escape_string($row['product_price']);
    $product_quantity = escape_string($row['product_quantity']);
    $product_description = escape_string($row['product_description']);
    $short_description = escape_string($row['short_description']);
    $product_image = escape_string($row['product_image']);
               


   }
   update_product();
}


?> 

<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Navn </label>
        <input type="text" value="<?php echo $product_title ?>" name="product_title" class="form-control">
       
    </div>


    <div class="form-group">
           <label for="product-title">Beskrivelse</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"><?php echo $product_description ?></textarea>
    </div>


     <div class="form-group">
           <label for="product-title">Kort beskrivelse</label>
      <textarea name="short_description" id="" cols="30" rows="3" class="form-control"><?php echo $short_description ?></textarea>
    </div>

     <div class="form-group row">

<div class="col-xs-3">
  <label for="product-price">Pris</label>
  <input value="<?php echo $product_price ?>"type="number" name="product_price" class="form-control" size="60">
</div>
</div>




    
    

</div>


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Opdater">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Kategori</label>
        <select name="product_category_id" id="" class="form-control">
        <option value="<?php echo $product_category_id; ?>"><?php echo show_product_category_title($product_category_id);?></option>
            <?php show_categories_in_add_product_page(); ?>
        </select>


</div>





    <!-- Product Quantity-->


    <div class="form-group">
      <label for="product-title">Antal</label>
        <input class="form-control" type="text" value="<?php echo $product_quantity ?>" type="number" name="product_quantity" id="">
    </div>


    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Tilføj billede</label>
        <input type="file" name="file"> <br>

<img class="img-responsive" src="<?php echo "../../resources/{$image}" ?>" width="150" alt="">
  
    </div>



</aside><!--SIDEBAR-->


    
</form>

