
<?php require_once("../resources/config.php") ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php")?>


         <!-- Forneden er en kontaktformular som bliver anvendt til at modtage beskeder fra kunderne. Den
         samler data'en fra brugeren og sender informationerne videre via. send_message() funktionen fra functions.php filen. -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Kontakt os</h2>
                    <h3 class="section-subheading">
                        <?php display_message();?>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" method="post">
                       <?php send_message(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Navn *" id="name" required data-validation-required-message="Venligst indtast dit navn.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email *" id="email" required data-validation-required-message="Venligst indtast din email-adresse.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input name="subject" type="subject" class="form-control" placeholder="Emne *" id="subject" required data-validation-required-message="Venligst indtast emnet.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" placeholder="Besked *" id="message" required data-validation-required-message="Venligst indtast din besked."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button name="submit" type="submit" class="btn btn-xl btn-primary">Send Besked</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
<?php require_once(TEMPLATE_FRONT . DS . "footer.php")?>