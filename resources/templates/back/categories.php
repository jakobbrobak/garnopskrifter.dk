
<!--  Denne side bliver brugt til at tilføje kategorier til siden ved hjælp af add_category() funktionen.
Derudover fremviser den de eksisterende kategorier ved hjælp af show_categories_in_admin()  -->

<h1 class="page-header">
  Kategorier

</h1>
<h4 class="bg-success text-center"><?php display_message(); ?></h4>
<?php add_category(); ?>

<div class="col-md-4">
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Titel</label>
            <input name="cat_title" type="text" class="form-control">
        </div>

        <div class="form-group">
            
            <input type="submit" name="add_category" class="btn btn-primary" value="Tilføj kategori">
        </div>      


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>Id</th>
            <th>Titel</th>
        </tr>
            </thead>


    <tbody>
        
           <?php show_categories_in_admin(); ?>
        
    </tbody>

        </table>

</div>

