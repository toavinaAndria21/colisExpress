<?php
require "./connexion.php"; 

function collectSenderForArray()
{
    try 
     {
        $connexion_db =  new Class_connexion('colis_express', 'localhost', 'root', '');
        $pdo_Stat = $connexion_db->conn->prepare('SELECT idEnvoi, nomEnvoyeur, emailEnvoyeur, colis FROM envoyer ORDER BY idEnvoi ASC');
        $pdo_Stat->execute();
        
        $resultArray = $pdo_Stat->fetchAll(PDO::FETCH_ASSOC);

       
        return $resultArray;

        
     }
    catch(PDOException $erreur)
     {
        echo 'Erreur lors de la récuperation : ' . $erreur->getMessage();
     }
    

}

echo json_encode(collectSenderForArray()); //recupere la variable $resultatArray retourner par la fonction collectSenderForArray();


?>