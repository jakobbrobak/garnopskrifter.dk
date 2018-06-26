<!-- Denne side bliver brugt til at fremvise de eksisterende produkter. Det gør den ved hjælp af 
get_products_in_admin() funktionen. -->


<div class="row">

<h1 class="page-header">
   Produkter

</h1>
<h4 class="bg-success text-center"><?php display_message(); ?></h4>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Id</th>
           <th>Produkt</th>
           <th>Kategori</th>
           <th>Antal på lager</th>
           <th>Styk pris</th>
      </tr>
    </thead>
    <tbody>

      
      <?php get_products_in_admin() ?>
      

  </tbody>
</table>


 </div>

     