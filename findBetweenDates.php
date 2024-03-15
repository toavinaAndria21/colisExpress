<?php
require "./rechercheColis.php";

$arrayOfDates = json_decode(file_get_contents("php://input"), true);

$objetRechercherColis = new RechercheColis(NULL, $arrayOfDates[0], $arrayOfDates[1]);

echo json_encode($objetRechercherColis->rechercheDates());

?>