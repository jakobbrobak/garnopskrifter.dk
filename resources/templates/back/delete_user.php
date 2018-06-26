<?php require_once("../../config.php");

/* Koden forneden bliver brugt til at slette en bruger med. */ 

if(isset($_GET['id'])) {

     
    $query = query("DELETE FROM users WHERE user_id = " .
    escape_string($_GET['id']) . " ");
    confirm($query);
    
    set_message("Bruger med ID-nr: <b>{$_GET['id']}</b> er hermed slettet");
    redirect("../../../public/admin/index.php?users");

} else {
    redirect("../../../public/admin/index.php?users");
}

?>