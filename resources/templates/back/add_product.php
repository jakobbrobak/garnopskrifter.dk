

<!--Denne side bliver brugt til at tilføje produkter til webshoppen fra admin-panelet. Det gør den ved hjælp af
add_product() funktionen. -->

<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Tilføj produkt

</h1>
<h4 class="bg-success text-center"><?php display_message(); ?></h4>
</div>
               


<form action="" method="post" enctype="multipart/form-data">

<?php add_product(); ?> 

<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Navn </label>
        <input type="text" name="product_title" class="form-control">
       
    </div>


    <div class="form-group">
           <label for="product-title">Beskrivelse</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>


     <div class="form-group">
           <label for="product-title">Kort beskrivelse</label>
      <textarea name="short_description" id="" cols="30" rows="3" class="form-control"></textarea>
    </div>

     <div class="form-group row">

<div class="col-xs-3">
  <label for="product-price">Pris</label>
  <input type="number" name="product_price" class="form-control" size="60">
</div>
</div>


</div>


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publicer">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Kategori</label>
        <select name="product_category_id" id="" class="form-control">
        <option value="">Vælg kategori</option>
            <?php show_categories_in_add_product_page(); ?>
        </select>


</div>





    <!-- Product Quantity-->


    <div class="form-group">
      <label for="product-title">Antal</label>
        <input class="form-control" type="number" name="product_quantity" id="">
    </div>


    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Tilføj billede</label>
        <input type="file" name="file">
      
    </div>



</aside><!--SIDEBAR-->


    
</form>

