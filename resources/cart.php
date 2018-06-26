<?php require_once("config.php") ?>

<!-- Denne side bliver brugt til at håndtere alt funktionalitet vedrørende indkøbskurven for webshoppen. -->

<?php 
/* Koden forneden bliver brugt til at sammenligne data fra databasen med det data som en potentiel kunde afgiver. 
   Mere specifikt, så hjælper koden til at undgå at en bruger kan købe en mængde af et produkt, som ikke er på lager.
   Der vil fremgå en fejlmeddelelse, hvis der ikke er nok efterspurgte enheder på lager.*/

if(isset($_GET['add'])) {
    
    $query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['add']));
    confirm($query);
    
    while($row = fetch_array($query)) {
        
        if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]){
            
            $_SESSION['product_' . $_GET['add']] +=1;
            redirect("../public/checkout.php");
            
            } else {
            
            $product_title = strtolower($row['product_title']);
            set_message("Vi har desværre kun {$row['product_quantity']} opskrifter af produktet {$product_title} tilbage"); 
            redirect("../public/checkout.php"); 
        }
    }  
}


/* Koden forneden fjerner 1 enhed af det produkt, som man gerne vil have reduceret i mængde. 
   Det kunne være i det tilfælde at man kom til at trykke 2 gange på købsknappen, men man kun vil have et styk. */

if(isset($_GET['remove'])) {
    $_SESSION['product_' . $_GET['remove']] --;
    
    if($_SESSION['product_' . $_GET['remove']] < 1) {
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);
        redirect("../public/checkout.php");
    } else {
        redirect("../public/checkout.php");
    }
}


/* Koden forneden bliver brugt til at fjerne et produkt fra indkøbskurven.*/

if(isset($_GET['delete'])) {
    $_SESSION['product_' . $_GET['delete']] = 0;
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);
    redirect("../public/checkout.php");
   
}

/* Funktionen forneden bliver brugt til at fremvise produkterne m.m. under Kurv-siden, 
   og giver derudover mulighed for at tilføje/reducere/fjerne produkter fra ens kurv
   ved hjælp af alt koden foroven.

Uddybet version:

1. Vi laver et foreach loop udfra det data der er i $_SESSION superglobal variablen.
   Det er i et assoc_array med en nøgle og en værdi. 

2. Hvis nøglen er mere end 0, så har vi data i array'et. 

3. Vi anvender så substr php funktionen, da vi skal have filtreret de første 8 karakterer fra,
   hvilket er: "product_" som vi derefter verificerer med == "product_" i vores if statement.

4. Vi benytter os nu af strlen php funktionen, da vi har brug for dynamisk at opsnappe nummeret/antallet
   efter "product_" da vi skal bruge det nummer, når vi skal søge produktet op i databasen. 
   Så vi minusser de 8 karakterer, så vi nu får den korrekte længde. 

5. Vi anvender derefter substr igen, hvor vi nu kan anvende variablen $length til at generere vores nye $id variable,
   som vi nu kan anvende i forbindelse med søgning i databasen. 


*/ 

function cart() {
    
    $total = 0;
    $sub = 0;
    $item_quantity = 0;
    $item_name = 1;
    $item_number = 1;
    $amount = 1; 
    $quantity = 1; 
    
    foreach($_SESSION as $name => $value){
        
        if($value > 0) {
            
            if(substr($name, 0, 8) == "product_") {
                
              $length = strlen($name) - 8;
                
              $id = substr($name, 8, $length);
              
              $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id));
              confirm($query);
    
       
    while($row = fetch_array($query)) {
        
         $sub = $row['product_price'] * $value;
         $item_quantity += $value;

         $image = display_image($row['product_image']);
           
        $product = <<<DELIMETER
        
          <tr>
                <td><img class="img-responsive" src="../resources/{$image}" width="150" alt=""></td>
                <td>{$row['product_title']}</td>
                <td>{$row['product_price']}</td>
                <td>{$value}</td>
                <td>{$sub}</td>
                <td>
                <a class="btn btn-warning" href="../resources/cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a>
                <a class="btn btn-success" href="../resources/cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>
                <a class="btn btn-danger" href="../resources/cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
              
            </tr>
            
            <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
            <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
            <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
            <input type="hidden" name="quantity_{$quantity}" value="{$value}">
        
DELIMETER;
        
        echo $product;
        
        $item_name++;
        $item_number++;
        $amount++;
        $quantity++; 
        
        
            }   
                
            $_SESSION['item_total'] = $total += $sub;
            $_SESSION['item_quantity'] = $item_quantity;
        
          }
            
        }
   
    }
        
}

/* Funktionen forneden bliver brugt til at holde paypal-knappen skjult, indtil 
der bliver tilføjet en eller flere varer til kurven. */

function show_paypal() {
    
    if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {

    
    $paypal_button = <<<DELIMETER

    <input type="image" name="upload"
    src="https://www.paypalobjects.com/webstatic/mktg/logo-center/logo_betal_med_PayPal_dk.png" width="140"
    alt="PayPal - The safer, easier way to pay online">

DELIMETER;

    return $paypal_button;

    }
}


  /* Funktionen forneden bliver blandt andet brugt til at opsnappe 
     de informationer der kommer fra paypal i forbindelse med et køb af en vare.
     Informationerne bliver derefter gemt i vores MySQL database. */

    /* Funktionen forneden bliver brugt til at lave rapporter over varerne
    som bliver købt samt tilhørende ordrenummer pr. ordre. Vi genanvender
    derudover noget kode fra cart funktionen. */ 

function process_transaction() {

    if(isset($_GET['tx'])) {


    $amount = escape_string($_GET['amt']);
    $transaction_number = escape_string($_GET['tx']);
    $status = escape_string($_GET['st']);
    $currency_code = escape_string($_GET['cc']);
    $total = 0;
    $sub = 0;
    $item_quantity = 0;
     
    
    foreach($_SESSION as $name => $value){
        
        if($value > 0) {
            
            if(substr($name, 0, 8) == "product_") {
                
              $length = strlen($name) - 8;
              $id = substr($name, 8, $length);

              $send_order = query("INSERT INTO orders 
              (order_amount, order_transaction, order_status, order_currency)
              VALUES ('{$amount}', '{$transaction_number}', '{$status}',
              '{$currency_code}')");

              $last_id = last_id();

              confirm($send_order);
              
              $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id));
              confirm($query);
    
       
    while($row = fetch_array($query)) {
         $product_price = $row['product_price'];
         $product_title = $row['product_title'];
         $sub = $row['product_price'] * $value;
         $item_quantity += $value;
         

         $insert_report = query("INSERT INTO reports 
         (product_id, order_id, product_title, product_price, product_quantity)
         VALUES ('{$id}', '{$last_id}', '{$product_title}', '{$product_price}', '{$value}')");

         confirm($insert_report);
        
        
            }   

            $total += $sub;
            $item_quantity;
        
          }
            
        }
   
    }
    session_destroy();  
  } else {
    redirect("index.php");
}

}


?>