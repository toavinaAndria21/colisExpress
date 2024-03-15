<?php
require"./envoyer.php";


    $senderIdToDelete = json_decode(file_get_contents("php://input"), true);
    $senderObject = new Envoyer($senderIdToDelete[0]);
    $senderObject->deleteEnvoyer();


?>