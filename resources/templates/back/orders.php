
<!-- Denne side bliver brugt til at fremvise de eksisterende ordrer. Det gør den ved hjælp af 
display_orders() funktionen. -->

<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   Ordrer

</h1>
<h4 class="bg-success text-center"><?php display_message(); ?></h4>
</div>
<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>Id</th>
           <th>Pris</th>
           <th>Transaktion</th>
           <th>Valuta</th>
           <th>Status</th>
      </tr>
    </thead>
    <tbody>
       
       <?php display_orders(); ?>
         

    </tbody>
</table>
</div>
