<?php


/* Denne side bliver brugt til at håndtere majoriteten af alt funktionalitet for hele siden. */




/* Variablen forneden bliver brugt i samarbejde med funktionen 
   display_image til at gemme det aktuelle mappenavn for upload
   folderen.*/ 

$upload_directory = "uploads"; 



/********************************************************HELPER FUNCTIONS*************************************************/



/* Funktionen forneden anvendes til at modtage det sidste id, som er 
   blevet gemt i databasen. */ 

function last_id() {

    global $connection;

    return mysqli_insert_id($connection);
}

/* Funktionen forneden bliver brugt til at placere en besked i $msg variablen. */

function set_message($msg){
    if(!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

/* Funktionen forneden bliver brugt til at fremvise en besked, for derefter at nulstille den.  */

function display_message(){
    if(isset($_SESSION['message'])){
        
        echo $_SESSION['message'];
        unset($_SESSION['message']); 
    }
}

// Funktionen forneden bliver brugt til at omdirigere.

function redirect($location){
    header("Location: $location ");
}

/* Funktionen forneden bliver brugt til at kommunikere med mysql- databasen. 
   Vi sender en query og forbinder ved hjælp af konstanterne som er placeret i $connection variablen. */

function query($sql){
    global $connection;
    return mysqli_query($connection, $sql);
}

/* Funktionen forneden bliver brugt til at hjælpe med at diagnosticere 
   fejl i forbindelse med opkobling til mysql-databasen. */

function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED " . mysqli_error($connection));
    }
}

/* Denne funktion bliver brugt til at undgå SQL-injections, 
   når brugerne har mulighed for at kommunikere med databasen ved hjælp af fx et loginsystem. */

function escape_string($string){
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

/* Denne funktion bliver ved hjælp af funktionen mysqli_fetch_array, 
   brugt til at gemme et udtræk fra mysql-databasen til et array */

function fetch_array($result){
     return mysqli_fetch_array($result);
}




/********************************************************FRONT END FUNCTIONS*************************************************/
    
    


/* Funktionen forneden bliver brugt til at hente produkterne
fra products-tabellen i MySQL-databasen. Vi anvender i samme ombæring nogle af de andre funktioner foroven.
Vi benytter endvidere en særlig teknik ved navn Heredoc i forbindelse med product variablen. 
Den teknik gør, at vi med lethed kan anvende html, uden at tænke på alle de "" som giver problemer for ens strings. */


function get_products(){
    $query = query("SELECT * FROM products");
    confirm($query);
    
    while($row = fetch_array($query)) {
           
        $image = display_image($row['product_image']);

        $product = <<<DELIMETER
        
        <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id={$row['product_id']}"><img src="../resources/{$image}" alt=""></a>
                            <div class="caption">
                                <h4 class="pull-right"> {$row['product_price']} kr.</h4>
                                <h4><a href="item.php?id={$row['product_id']} ">{$row['product_title']}</a>
                                </h4> 
                                <p>{$row['short_description']}</p>
                                <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Tilføj til kurv</a>
                            </div>  
                        </div>
                    </div>
DELIMETER;
        
        echo $product;
                       
        }
    
}


/* Funktionen forneden minder meget om get_products() derfor henvises der til dennes dokumentation.
   Der er dog en markant ændring her, hvilket består i, at vi anmoder om data for et specifikt produkt. */ 

function get_product_item(){
    $query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
    confirm($query);
    
    while($row = fetch_array($query)) {
           
        $image = display_image($row['product_image']);

        $item = <<<DELIMETER
        
        <div class="col-md-9">

<!--Row For Image and Short Description-->

<div class="row">

    <div class="col-md-7">
       <img class="img-responsive" src="../resources/{$image}" alt="">

    </div>

    <div class="col-md-5">

        <div class="thumbnail">
         

    <div class="caption-full">
        <h4><a href="#">{$row['product_title']}</a> </h4>
        <hr>
        <h4 class="">{$row['product_price']} kr.</h4>

    <div class="ratings">
     
        <p>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star-empty"></span>
            4.0 Stjerner
        </p>
    </div>
          
        <p>{$row['short_description']}</p>

   
    
        <div class="form-group">
            <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Tilføj til kurv</a>
        </div>
    

    </div>
 
</div>

</div>


</div><!--Row For Image and Short Description-->


        <hr>


<!--Row for Tab Panel-->

<div class="row">

<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Beskrivelse</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Anmeldelser</a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">

<p></p>
           
    <p>{$row['product_description']}</p>

    </div>
    <div role="tabpanel" class="tab-pane" id="profile">

  <div class="col-md-6">

       <h3>3 anmeldelser fra </h3>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Niels
                <span class="pull-right">5 dage siden</span>
                <p>Produktet er bare super!</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Jens
                <span class="pull-right">12 dage siden</span>
                <p>Jeg køber gerne af denne person igen.</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                Lene
                <span class="pull-right">15 dage siden</span>
                <p>Prisen for denne kvalitet er intet mindre end utroligt!</p>
            </div>
        </div>

    </div>


    <div class="col-md-6">
        <h3>Tilføj en anmeldelse</h3>

     <form action="" class="form-inline">
        <div class="form-group">
            <label for="">Navn</label>
                <input type="text" class="form-control" >
            </div>
             <div class="form-group">
            <label for="">Email</label>
                <input type="test" class="form-control">
            </div>

        <div>
            <h3>Din bedømmelse</h3>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
        </div>

            <br>
            
             <div class="form-group">
             <textarea name="" id="" cols="60" rows="10" class="form-control"></textarea>
            </div>

             <br>
              <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Gem">
            </div>
        </form>

    </div>

 </div>

 </div>

</div>


</div><!--Row for Tab Panel-->




</div> 
        
       
DELIMETER;
        
        echo $item;
                       
        }
    
}


/* Funktionen forneden minder meget om get_products() derfor henvises der til dennes dokumentation.
   Der er dog en markant ændring her, hvilket består i, at vi anmoder om data for en specifik kategori. */ 


function get_products_by_categories(){
    $query = query("SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " ");
    confirm($query);
    
    while($row = fetch_array($query)) {
           
        $image = display_image($row['product_image']);

        $item = <<<DELIMETER
        
<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/{$image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_description']}</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Køb Nu!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">Mere Information</a>
                        </p>
                    </div>
                </div>
            </div>
        
       
DELIMETER;
        
        echo $item;
                       
        }
    
}

/* Funktionen forneden minder meget om get_products() derfor henvises der til dennes dokumentation. */

function get_products_in_shop_page(){
    $query = query("SELECT * FROM products");
    confirm($query);
    
    while($row = fetch_array($query)) {
           
        $image = display_image($row['product_image']); 
        
        $item = <<<DELIMETER
        
<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img src="../resources/{$image}" alt=""></a>
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_description']}</p>
                        <p>
                            <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Tilføj til kurv</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">Mere Information</a>
                        </p>
                    </div>
                </div>
            </div>
        
       
DELIMETER;
        
        echo $item;
                       
        }
    
}




/* Funktionen forneden minder meget om get_products() derfor henvises der til dennes dokumentation. */

function get_categories() {
            
            $query = "SELECT * FROM categories";
            $send_query = query($query);
            confirm($send_query);
                    
            while($row = fetch_array($send_query)) {

            $category = <<<DELIMETER
            
            <a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;
                
        echo $category;
      }
}


/* Funktionen forneden bliver brugt i forbindelse med login af en bruger. 
   Vi tjekker først om login knappen "submit" er trykket på, og hvis den er det,
   så gemmer vi informationerne fra de 2 $_POST super globals og placerer dem i hhv. $username og $password variablerne.
   De bliver i samme ombæring tjekket for SQL-injections via. escape_string funktionen.

   Vi laver derefter en query til databasen, hvor vi tjekker om brugeren eksistere samt om passwordet er korrekt, hvis brugeren gør og 
   passwordet er korrekt, så bruger vi funktionen redirect til at henvise brugeren til admin området.
   Hvis brugeren dog ikke eksistere, anvender vi samme funktion, 
   til at henvise brugeren til login-siden igen samt vise en besked. 
   
   Vi tjekker derudover om det hashed password, der blev genereret da brugeren blev oprettet,
   om det stemmer overens med det indtastede password, ved hjælp af hash_equals og crypt funktionerne.  */

function login_user() {
     
    if(isset($_POST['submit'])){
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);
        
        $query = query("SELECT * FROM users WHERE username = '{$username}'");
        confirm($query);

        while($row = fetch_array($query)) {

        $hashed_password = $row['password']; 
    }

    if (hash_equals($hashed_password, crypt($password, $hashed_password))) {
        $_SESSION['username'] = $username;
        redirect("admin"); 
    } else {
        set_message("Din adgangskode eller brugernavn er blevet indtastet forkert. Forsøg venligst igen. ");
        redirect("login.php");
    }

  }

}

/* Funktionen forneden bliver anvendt til at opsnappe informationerne fra kontaktformularen på contact.php
   via. $_POST super global variablen for derefter at blive sendt via. email ved hjælp af php's mail() funktion.
   Vi anvender derudover vores egne hjælpe-funktioner til at sætte en besked samt redirecte.*/

function send_message() {
    
    if(isset($_POST['submit'])) {
        $to      = "info@bapp.dk";
        $name    = $_POST['name'];
        $email   = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        $headers = "From: {$name} {$email}";
        
        $result = mail($to, $subject, $message, $headers);
        
        if(!$result) {
            set_message("Vi kunne desværre ikke sende din besked. Prøv igen.");
            redirect("contact.php");
        } else {
            set_message("Din besked er sendt!");
            redirect("contact.php");
        }
    }
    
}




/********************************************************BACK END FUNCTIONS*************************************************/






/********************************************************DISPLAY ORDERS*************************************************/



/* Funktionen forneden bliver brugt til at vise alt fra orders-tabellen.
   Vi placerer derefter indholdet på Ordrer-siden under Admin-panelet.*/

function display_orders() {

    $query = query("SELECT * FROM orders");
    confirm($query);
      
    while($row = fetch_array($query)) {

        $orders = <<<DELIMETER
        
    <tr>
        <td>{$row['order_id']}</td>
        <td>{$row['order_amount']}</td>
        <td>{$row['order_transaction']}</td>
        <td>{$row['order_currency']}</td>
        <td>{$row['order_status']}</td>
        <td><a class="btn btn-danger" 
        href="../../resources/templates/back/delete_order.php?id={$row['order_id']}">
        <span class="glyphicon 
        glyphicon-remove "></span></a></td>
    </tr>


DELIMETER;
            
    echo $orders;
  }
}





/********************************************************ADMIN PRODUCTS PAGE*************************************************/




/* Funktionen forneden bliver brugt til at forbinde parameter-værdien
   til mappenavnet for upload folderen, hvor billederne skal opbevares.*/

function display_image($picture){

    global $upload_directory;

    return $upload_directory . DS . $picture; 

}



/* Funktionen forneden henter produkterne fra products-tabellen
   og placerer dem på Produkter-siden under admin-panelet.*/ 


function get_products_in_admin() {

   
    $query = query("SELECT * FROM products");
    confirm($query);
    
    while($row = fetch_array($query)) {

       $category_title = show_product_category_title($row['product_category_id']);
       $image = display_image($row['product_image']);
           
        $product = <<<DELIMETER

            <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']}
            <a href="index.php?edit_product&id={$row['product_id']}">
            <img class="img-responsive" src="../../resources/{$image}" width="150" alt="">
            </a>
            </td>
            <td>{$category_title}</td>
            <td>{$row['product_quantity']}</td>
            <td>{$row['product_price']} DKK</td>
            <td><a class="btn btn-danger" 
            href="../../resources/templates/back/delete_product.php?id={$row['product_id']}">
            <span class="glyphicon 
            glyphicon-remove "></span></a></td>
            </tr>

DELIMETER;
        
        echo $product;
                       
        }


}


/* Funktionen forneden bliver brugt til at joine categories-tabellen
   med products-tabellen. Så vi får mulighed ud fra product_category_id
   til at modtage cat_title, da product_category_id og cat_id er det
   samme. */

function show_product_category_title($product_category_id){

      
    $category_query = query("SELECT * FROM categories WHERE 
    cat_id = {$product_category_id}");
    confirm($category_query);

    while($category_row = fetch_array($category_query)) {

          return $category_row['cat_title']; 

    }
     

}





/********************************************************ADD PRODUCTS IN ADMIN *************************************************/




/* Funktionen forneden tilføjer et nyt produkt som den placerer i databasen.
   Derudover placerer den billedet i upload-mappen. Stien til billedet, vil
   dog blive gemt i tabellen. */ 

function add_product() {

     
      if(isset($_POST['publish'])) {

         $product_title = escape_string($_POST['product_title']);
         $product_category_id = escape_string($_POST['product_category_id']);
         $product_price = escape_string($_POST['product_price']);
         $product_quantity = escape_string($_POST['product_quantity']);
         $product_description = escape_string($_POST['product_description']);
         $short_description = escape_string($_POST['short_description']);
         $product_image = escape_string($_FILES['file']['name']);
         $image_temp_location = escape_string($_FILES['file']['tmp_name']);

      
           move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY .
           DS . $product_image);   
           
           
           $query = query("INSERT INTO products(product_title,
           product_category_id, product_price, product_quantity,
           product_description, short_description, product_image) 
           VALUES('{$product_title}', '{$product_category_id}', '{$product_price}',
           '{$product_quantity}', '{$product_description}', '{$short_description}', 
           '{$product_image}')  ");

           $last_id = last_id();

           confirm($query);
           set_message("Nyt produkt med ID-nr: {$last_id} tilføjet");
           redirect("index.php?products");
      
        }



}


/* Funktionen forneden bliver brugt til at vise kategorierne på 
   Tilføj produkter siden. */

function show_categories_in_add_product_page() {
            
    $query = "SELECT * FROM categories";
    $send_query = query($query);
    confirm($send_query);
            
    while($row = fetch_array($send_query)) {

    $category_options = <<<DELIMETER
    
    <option value="{$row['cat_id']}">{$row['cat_title']}</option>
DELIMETER;
        
echo $category_options;
}
}




/********************************************************UPDATE PRODUCTS IN ADMIN *************************************************/




/* Funktionen forneden bliver brugt til at opdatere produktet 
   i databasen. */ 

function update_product() {

     
    if(isset($_POST['update'])) {

       $product_title = escape_string($_POST['product_title']);
       $product_category_id = escape_string($_POST['product_category_id']);
       $product_price = escape_string($_POST['product_price']);
       $product_quantity = escape_string($_POST['product_quantity']);
       $product_description = escape_string($_POST['product_description']);
       $short_description = escape_string($_POST['short_description']);
       $product_image = escape_string($_FILES['file']['name']);
       $image_temp_location = escape_string($_FILES['file']['tmp_name']);

          
         if(empty($product_image)){
             
 
             $get_picture = query("SELECT product_image FROM products
             WHERE product_id = " . escape_string($_GET['id']));
             confirm($get_picture);

             while($picture = fetch_array($get_picture)) {
                  
                   $product_image = $picture['product_image'];

            }

         }



         move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY .
         DS . $product_image);   
         
         $query = "UPDATE products SET ";
         $query .= "product_title        = '{$product_title}', ";
         $query .= "product_category_id  = '{$product_category_id}', ";
         $query .= "product_price        = '{$product_price}', ";
         $query .= "product_quantity     = '{$product_quantity}', ";
         $query .= "product_description  = '{$product_description}', ";
         $query .= "short_description    = '{$short_description}', ";
         $query .= "product_image        = '{$product_image}'  ";
         $query .= "WHERE product_id = " . escape_string($_GET['id']);
         
         $send_update_query = query($query);

         confirm($send_update_query);
         set_message("Produktet er blevet opdateret!");
         redirect("index.php?products");
    
      }



}



/********************************************************CATEGORIES IN ADMIN *************************************************/



/* Funktionen forneden laver et udtræk fra databasen, hvor den viser
   alle kategorier med hhv. id og titel. */

function show_categories_in_admin() {

   
    $category_query = query("SELECT * FROM categories");
    confirm($category_query);

    while($row = fetch_array($category_query)) {

         $cat_id = $row['cat_id'];
         $cat_title = $row['cat_title'];


         $category = <<<DELIMETER

         <tr>
           <td>{$cat_id}</td>
           <td>{$cat_title}</td>
           <td><a class="btn btn-danger" 
            href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}">
            <span class="glyphicon 
            glyphicon-remove "></span></a></td>
         </tr>

DELIMETER;

     echo $category;

    }
   

}


/* Funktionen forneden tilføjer en ny kategori til databasen.*/


function add_category() {

   if(isset($_POST['add_category'])) {
      
      $cat_title = escape_string($_POST['cat_title']);

      if(empty($cat_title) || $cat_title == " ") {
        
          echo "<h4 class='bg-danger text-center'>Feltet må ikke være tomt!</h4>";

      } else {

      $insert_cat = query("INSERT INTO categories(cat_title)
      VALUES('{$cat_title}')");

      confirm($insert_cat);
      set_message("Kategorien: {$cat_title} er blevet tilføjet!");
      redirect("index.php?categories");
     }

   }

}




/********************************************************USERS IN ADMIN*************************************************/





/* Funktionen forneden viser et udtræk af brugerne fra databasen. */


   function display_users() {

   
    $users_query = query("SELECT * FROM users");
    confirm($users_query);

    while($row = fetch_array($users_query)) {

         $user_id = $row['user_id'];
         $username = $row['username'];
         $email = $row['email'];

         $user = <<<DELIMETER

       <tr>
         <td>{$user_id}</td>
         <td>{$username}</td>
         <td>{$email}</td>
         <td>
            <a class="btn btn-warning" 
            href="index.php?edit_user&id={$row['user_id']}">
            <span class="glyphicon 
            glyphicon-edit"></span></a>
            <a class="btn btn-danger" 
            href="../../resources/templates/back/delete_user.php?id={$row['user_id']}">
            <span class="glyphicon 
            glyphicon-remove "></span></a>
        </td>
       </tr>

DELIMETER;

     echo $user;

    }
   

}


/* Funktionen forneden bliver brugt til at tilføje en ny bruger. */

function add_user() {
   

    if(isset($_POST['add_user'])) {
        
       
        $username = escape_string($_POST['username']);
        $email = escape_string($_POST['email']);
        $password = escape_string($_POST['password']);
        
        $password = crypt($password);

        $user_query = query("INSERT INTO users(username, email, password) 
        VALUES('{$username}', '{$email}', '{$password}')");

        confirm($user_query);
        set_message("Brugeren: {$username} er blevet tilføjet!");
        redirect("index.php?users");

    }


}


/* Funktionen forneden bliver brugt til at opdatere en brugers informationer. */ 

function update_user() {
  
     
    if(isset($_POST['update_user'])) {

        $username = escape_string($_POST['username']);
        $email = escape_string($_POST['email']);
        $password = escape_string($_POST['password']);
      
        $password = crypt($password);   
         
         $query = "UPDATE users SET ";
         $query .= "username        = '{$username}', ";
         $query .= "email           = '{$email}', ";
         $query .= "password        = '{$password}' ";
         $query .= "WHERE user_id   = " . escape_string($_GET['id']);
         
         $send_update_query = query($query);

         confirm($send_update_query);
         set_message("Brugeren med ID-nr: {$_GET['id']} er blevet opdateret!");
         redirect("index.php?users");
    
      }



}




/********************************************************REPORTS IN ADMIN*************************************************/




/* Funktionen forneden henter rapporterne/statistik fra reports-tabellen
   og placerer dem på Salg-siden under admin-panelet.*/ 


   function get_reports() {

   
    $query = query("SELECT * FROM reports");
    confirm($query);
    
    while($row = fetch_array($query)) {
 
        $report = <<<DELIMETER

            <tr>
            <td>{$row['report_id']}</td>
            <td>{$row['product_id']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['product_title']}</td>
            <td>{$row['product_price']} DKK</td>
            <td>{$row['product_quantity']}</td>
            <td><a class="btn btn-danger" 
            href="../../resources/templates/back/delete_report.php?id={$row['report_id']}">
            <span class="glyphicon 
            glyphicon-remove "></span></a></td>
            </tr>

DELIMETER;
        
        echo $report;
                       
        }


}



?>