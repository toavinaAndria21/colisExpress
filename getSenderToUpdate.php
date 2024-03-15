<?php

require"./envoyer.php";
//recupere les données de l'envoyeur de la ligne selectionnée et les affiche dans les inputs du formuliare de modification;
$senderIdToUpdate = json_decode(file_get_contents("php://input"), true);

$objetEnvoyer = new Envoyer($senderIdToUpdate[0]);

echo json_encode($objetEnvoyer->getSenderToUpdate());


?>