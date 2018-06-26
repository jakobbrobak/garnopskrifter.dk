<?php require_once("../../config.php");

/* Koden forneden bliver brugt til at slette et produkt med. */ 

if(isset($_GET['id'])) {

     
    $query = query("DELETE FROM products WHERE product_id = " .
    escape_string($_GET['id']) . " ");
    confirm($query);
    
    set_message("Produktet med ID-nr: <b>{$_GET['id']}</b> er hermed slettet");
    redirect("../../../public/admin/index.php?products");

} else {
    redirect("../../../public/admin/index.php?products");
}












?>