<?php
include "./envoyer.php";
//include "./itineraire.php";

$senderDatFromJs = json_decode(file_get_contents("php://input"), true);
$envoyerObject = new Envoyer(NULL, $senderDatFromJs[0], $senderDatFromJs[1], $senderDatFromJs[2], $senderDatFromJs[3], $senderDatFromJs[4], $senderDatFromJs[5], $senderDatFromJs[6], $senderDatFromJs[7]);
$envoyerObject->insererEnvoyer();

//$itineraireObject = new itineraire($senderDatFromJs[8], $senderDatFromJs[9], $senderDatFromJs[10]);
//$itineraireObject->insererItineraire();


?>