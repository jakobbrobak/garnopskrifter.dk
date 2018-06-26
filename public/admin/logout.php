<?php 

/* Koden forneden bliver brugt til at logge ud af admin-panelet. 
   Vi anvender i den forbindelse 3 funktioner. Session_start som
   påbegynder en session, efterfulgt af session_destroy som
   nulstiller sessionen. Så vi ikke længere har de informationer
   som er gemt i superglobal variablen $_SESSION. Derudover anvender
   vi funktionen header som omdirigere brugeren til forsiden.*/

session_start();
session_destroy();

header("Location: ../../public"); 



?>