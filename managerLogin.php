<?php
     
    require "./gerant.php";
     
    $arrayManager = json_decode(file_get_contents("php://input"), true);
    $gerant1 = new Gerant($arrayManager[0], $arrayManager[1]);
    echo json_encode( $gerant1->connexionGerant() );
                    
?>