<?php

require"./envoyer.php";
//recupere les données de l'envoyeur de la ligne selectionnée et les affiche dans les inputs du formuliare de modification;
$objetEnvoyer = new Envoyer();

echo json_encode($objetEnvoyer->recetteTotale());


?>