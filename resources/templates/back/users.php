
<!-- Denne side bliver brugt til at fremvise de eksisterende brugere. Det gør den ved hjælp af 
display_users() funktionen. -->

<div class="col-lg-12">
    

    <h1 class="page-header">
        Brugere
        
    </h1>
    <h4 class="bg-success text-center"><?php display_message(); ?></h4>
        <p class="bg-success">
    </p>

    <a href="index.php?add_user" class="btn btn-primary">Tilføj bruger</a>


    <div class="col-md-12">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Brugernavn</th>
                    <th>E-mail</th>
                </tr>
            </thead>
            <tbody>

                <?php display_users(); ?>
                
            </tbody>
        </table> <!--End of Table-->
    

    </div>










                        
                    </div>
    
