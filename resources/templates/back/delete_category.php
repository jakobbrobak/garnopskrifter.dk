<?php require_once("../../config.php");

/* Koden forneden bliver brugt til at slette en kategori med. */ 

if(isset($_GET['id'])) {

     
    $query = query("DELETE FROM categories WHERE cat_id = " .
    escape_string($_GET['id']) . " ");
    confirm($query);
    
    set_message("Kategori med ID-nr: <b>{$_GET['id']}</b> er hermed slettet");
    redirect("../../../public/admin/index.php?categories");

} else {
    redirect("../../../public/admin/index.php?categories");
}












?>