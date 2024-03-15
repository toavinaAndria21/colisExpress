<?php
   require "./itineraire.php";

    $codeIt = json_decode(file_get_contents("php://input"), true);
    $itinerary = new itineraire($codeIt[0]);

    echo json_encode($itinerary->readDestination());


?>