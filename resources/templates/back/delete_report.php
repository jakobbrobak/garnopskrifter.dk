<?php require_once("../../config.php");

/* Koden forneden bliver brugt til at slette en rapport med. */ 

if(isset($_GET['id'])) {

     
    $query = query("DELETE FROM reports WHERE report_id = " .
    escape_string($_GET['id']) . " ");
    confirm($query);
    
    set_message("Rapporten med ID-nr: <b>{$_GET['id']}</b> er hermed slettet");
    redirect("../../../public/admin/index.php?reports");

} else {
    redirect("../../../public/admin/index.php?reports");
}

?>