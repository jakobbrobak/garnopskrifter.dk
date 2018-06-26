<?php

/* Denne side bliver brugt til at håndtere alt vores konfiguration. Det er nemmere at placere det hele i en fil,
   for så er det blot denne vi behøver at referere til, når vi skal bruge dens informationer. */



ob_start(); // Starter for output buffering

session_start(); // Opretter eller genopretter en session 

//session_destroy(); // Bliver brugt til at nulstille en session, i forbindelse med debugging. 

/* Funktionen forneden tjekker om DS er blevet defineret, hvis den er, 
så bliver den tildelt værdien NULL. Hvis den dog ikke er, så bliver den defineret med 
værdien: DIRECTORY_SEPARATOR. Hvilket er en prædefineret konstant for PHP,
som bliver brugt til at understøtte forskellige platforme. Der anvender forskellige "Separators". 
MAC anvender fx "/" hvorimod Windows anvender "\" Det tager den højde for. 
*/

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

/* De 2 funktioner forneden bliver brugt til at lave genveje ved 
hjælp af "__DIR__" som giver hele stien til roden af sitet. "__DIR__" bliver så tilknyttet DS(Separator)
samt resten af stien ved hjælp af concatenation/sammenkædning. Her bliver igen anvendt en ternary operator. 
*/

defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY", __DIR__ . DS . "uploads");

/* Forneden definerer vi igen 4 konstanter ved hjælp af en ternary operator.
Her har vi så loginoplysningerne til database-serveren. 
*/

defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER", "root");

defined("DB_PASS") ? null : define("DB_PASS", "root");

defined("DB_NAME") ? null : define("DB_NAME", "garnopskrifter");

/* Vi gemmer nu konstanterne fra oven ved hjælp af mysqli_connection funktionen,
   og placerer dem i en variable ved navn $connection.*/

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

/* Funktionen require_once anvendes til at oprette forbindelse til functions.php filen, så vi kan benytte os af de funktioner 
   samt variabler m.m. der måtte være gemt der, i denne fil (config.php) */
   
require_once("functions.php");
require_once("cart.php");
?>