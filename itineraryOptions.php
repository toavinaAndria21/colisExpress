<?php

require"./itineraire.php";

$objetItineraire = new itineraire();

echo json_encode($objetItineraire->readItineraire());


?>