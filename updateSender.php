<?php
require"./envoyer.php";


$senderInformation = json_decode(file_get_contents("php://input"), true);
$senderObject = new Envoyer($senderInformation[0], $senderInformation[1], $senderInformation[2], $senderInformation[3], $senderInformation[4], $senderInformation[5], $senderInformation[6], $senderInformation[7]);
//$senderObject = new Envoyer(35, 'iy', 'en', 'rorp', NULL, 'momi@', 'hdj', '500');
$senderObject->updateEnvoyer();


?>