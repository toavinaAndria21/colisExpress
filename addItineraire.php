<?php
include "./itineraire.php";



$senderDatFromJs = json_decode(file_get_contents("php://input"), true);
$itineraireObject = new itineraire($senderDatFromJs[0], $senderDatFromJs[1], $senderDatFromJs[2]);
$itineraireObject->insererItineraire();




?>