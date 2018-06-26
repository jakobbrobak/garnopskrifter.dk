<?php require_once("../../config.php");

/* Koden forneden bliver brugt til at slette en ordre med. */ 

if(isset($_GET['id'])) {

     
    $query = query("DELETE FROM orders WHERE order_id = " .
    escape_string($_GET['id']) . " ");
    confirm($query);
    
    set_message("Ordren med ID-nr: <b>{$_GET['id']}</b> er hermed slettet");
    redirect("../../../public/admin/index.php?orders");

} else {
    redirect("../../../public/admin/index.php?orders");
}

?>