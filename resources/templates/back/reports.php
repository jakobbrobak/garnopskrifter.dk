
<!-- Denne side bliver brugt til at fremvise de eksisterende rapporter. Det gør den ved hjælp af 
get_reports() funktionen. -->

<div class="row">

<h1 class="page-header">
   Rapporter

</h1>
<h4 class="bg-success text-center"><?php display_message(); ?></h4>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Id</th>
           <th>ProduktID</th>
           <th>OrdreID</th>
           <th>Produkt Titel</th>
           <th>Produkt Pris</th>
           <th>Antal af produkter</th>
      </tr>
    </thead>
    <tbody>

      
    <?php get_reports(); ?>
      

  </tbody>
</table>


 </div>

     