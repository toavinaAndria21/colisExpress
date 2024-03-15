<?php
require"./connexion.php";


function getLastSenderId($email)
    {
        $connexion_db =  new Class_connexion('colis_express', 'localhost', 'root', '');
        $pdo_Stat = $connexion_db->conn->prepare('SELECT idEnvoi From envoyer WHERE emailEnvoyeur = ? ORDER BY idEnvoi DESC LIMIT 1');
        $pdo_Stat->execute([$email]);
        $idEnvoi = $pdo_Stat->fetch(PDO::FETCH_ASSOC);

        if($idEnvoi)
        {
            $premier_valeur_int=intval(reset($idEnvoi));
            $connexion_db = NULL;
            return $premier_valeur_int;
        }
    else 
        {
            echo 'aucun resultat trouvé';
        }
    }

?>