<?php
 
require "./lastSenderId.php"; //efa misy require"./connexion.php" ato donc tsy mila miverina manao include connexion.php intsony


function getDataFromDataBase()
    {
        $emailFromJs = json_decode(file_get_contents("php://input"), true); //recupere l'email saisie sur la bare de recherche
        $lastIdEnvoi = getLastSenderId($emailFromJs[0]); //recupere le dernier id de l'envoyeur qui a l'email $emailFromJs;

        $connexion_db = new Class_connexion('colis_express', 'localhost', 'root', '');
        $pdo_Stat = $connexion_db->conn->prepare('SELECT nomEnvoyeur, emailEnvoyeur, colis, nomRecepteur, frais FROM envoyer WHERE idEnvoi = ?');
        $pdo_Stat->execute([$lastIdEnvoi]);

        $emailFromDB = $pdo_Stat->fetch(PDO::FETCH_ASSOC);
       // print_r($emailFromDB);

        return $emailFromDB;

    }

 echo json_encode(getDataFromDataBase());

?>