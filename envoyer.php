<?php

require "./connexion.php"; 


class Envoyer
{
    
    public $_idVoiture;
    public $_idEnvoi;
    public $_senderId;
    public $_colis;
    public $_nomEnvoyer;
    public $_emailEnvoyer;
    public $_dateEnvoi;
    public $_frais;
    public $_nomRecepteur;
    public $_contactRecepteur;
    public $connexion_db;
    public $_montant;

   public function __construct($sender_Id=NULL, $nom_Envoyer= NULL, $nom_Recepteur= NULL,  $colis= NULL, $date_Envoi= NULL, $email_Envoyer= NULL, $contact_Recepteur= NULL, $frais= NULL, $id_Voiture= NULL)
        {
            $this->_senderId = $sender_Id; //utilisé pour la methode de suppresion d'envoyeur
            $this->_idVoiture = $id_Voiture;
            $this->_colis = $colis;
            $this->_nomEnvoyer = $nom_Envoyer;
            $this->_emailEnvoyer = $email_Envoyer;
            $this->_dateEnvoi = $date_Envoi;
            $this->_frais = $frais;
            $this->_nomRecepteur = $nom_Recepteur;
            $this->_contactRecepteur = $contact_Recepteur;

            $this->connexion_db =  new Class_connexion('colis_express', 'localhost', 'root', '');
        }

    public function recupererDernierIdEnvoyer()
      {
        try 
            {
                $pdo_stat2=$this->connexion_db->conn->prepare('SELECT idEnvoi From envoyer WHERE emailEnvoyeur = ? ORDER BY idEnvoi DESC LIMIT 1');
                $pdo_stat2->execute([ $this->_emailEnvoyer]);
                $array_result= $pdo_stat2->fetch(PDO::FETCH_ASSOC);

            if($array_result)
                {
                    $premier_valeur_int=intval(reset($array_result));
                    echo $premier_valeur_int;
                }
            else 
                {
                    echo 'aucun resultat trouvé';
                }
            }
               catch(PDOException $erreur)
            {
            echo 'Erreur de recuperation' . $erreur->getMessage();
            }    
        
        return $premier_valeur_int;    
      }

    public function insererEnvoyer()
        {
            try 
                {
                    

                    $pdo_stat=$this->connexion_db->conn->prepare('INSERT INTO envoyer(idVoit, colis, nomEnvoyeur, emailenvoyeur, date_Envoi, frais, nomRecepteur, contactRecepteur) VALUES(?, ?, ?, ?,?, ?, ?, ?)');
                    $pdo_stat->execute([ 
                        $this->_idVoiture, 
                        $this->_colis, 
                        $this->_nomEnvoyer, 
                        $this->_emailEnvoyer, 
                        $this->_dateEnvoi,
                        $this->_frais,  
                        $this->_nomRecepteur,  
                        $this->_contactRecepteur 
                    ]);
                }
            catch(PDOException $erreur)
                {
                    echo 'Erreur d\'insertion' . $erreur->getMessage();
                } 
              ;       


        }
    public function updateEnvoyer()
        {

       // $this->_idEnvoi=$this->recupererDernierIdEnvoyer();
            try
            {     

                $pdo_stat=$this->connexion_db->conn->prepare('UPDATE envoyer SET colis=?, nomEnvoyeur=?, emailEnvoyeur=?, date_Envoi=?, frais=?, nomRecepteur=?, contactRecepteur=? WHERE idEnvoi = ?');
                $pdo_stat->execute([
                            $this->_colis, 
                            $this->_nomEnvoyer, 
                            $this->_emailEnvoyer, 
                            $this->_dateEnvoi,
                            $this->_frais,  
                            $this->_nomRecepteur,  
                            $this->_contactRecepteur,
                            $this->_senderId
                ]);  
              
             
                
            }
        catch(PDOException $erreur)
            {
                echo 'Erreur de mise à jour' . $erreur->getMessage();
            }
        
        }

    public function deleteEnvoyer()
        {
            try
            {
                 //  $this->_idEnvoi=$this->recupererDernierIdEnvoyer();
                $pdo_stat = $this->connexion_db->conn->prepare('DELETE FROM envoyer WHERE idEnvoi = ?');
                $pdo_stat->execute([$this->_senderId]);
                
            }catch (PDOException $error)
            {
                echo 'Erreur de supression : ' . $error->getMessage(); 
            }
         
        } 
    
    public function readEnvoyer()
        {
            $this->_idEnvoi=$this->recupererDernierIdEnvoyer();
            $pdo_stat = $this->connexion_db->conn->prepare('SELECT * FROM envoyer WHERE idEnvoi = ?');
            $pdo_stat->execute([$this->_idEnvoi]);
            //$article = $pdo_stat->fetch(PDO::FETCH_ASSOC);
            //print_r($article);

        }
    public function getSenderToUpdate()
      {
        try 
        {
            $pdo_stat = $this->connexion_db->conn->prepare('SELECT nomEnvoyeur, emailEnvoyeur, colis, date_Envoi, nomRecepteur, contactRecepteur, frais FROM envoyer WHERE idEnvoi = ?');
            $pdo_stat->execute([$this->_senderId]);
            $row = $pdo_stat->fetchAll(PDO::FETCH_ASSOC);

            return $row;
        }
        catch(PDOException $erreur)
        {
              echo 'Erreur de mise à jour: ' . $erreur->getMessage();
        }
      }    

    public function readAllEnvoyer()
        {
            try
              {
                $sql = 'SELECT * FROM envoyer';
                $resultat = $this->connexion_db->conn ->query($sql);
                          
                    while( $row = $resultat->fetch(PDO::FETCH_ASSOC))
                        {
                           
                                echo ' : ' . $row['idEnvoi'] . "  ";
                                echo ' : ' . $row['idVoit'] . "  ";
                                echo ' : ' . $row['colis'] . " ";
                                echo ' : ' . $row['nomEnvoyeur'] . "  ";
                                echo ' : ' . $row['emailEnvoyeur'] . "  ";
                                echo ' : ' . $row['date_Envoi'] . " ";
                                echo ' : ' . $row['frais'] . "  ";
                                echo ' : ' . $row['nomRecepteur'] . "  ";
                                echo ' : ' . $row['contactRecepteur'] . "\n";
                        }
              }
             catch(PDOException $erreur)
              {
                    echo 'Erreur de listage: ' . $erreur->getMessage();
              }
            
        }

    public function recetteTotale()
        {
                try
                {
                        $sql = 'SELECT frais FROM envoyer';
                        $resultat = $this->connexion_db->conn ->query($sql);
                        $montant = 0;    
                            while( $row = $resultat->fetch(PDO::FETCH_ASSOC))
                                {                          
                                    //  echo ' : ' . $row['frais'] . "  ";
                                        $montant = $montant + (int)$row['frais'];                           
                                }
                                $this->_montant = $montant;

                        return $this->_montant;
                            // echo "\n".'Le montant vaut: '.$this->_montant;
                }
                catch(PDOException $erreur)
                {
                        echo 'Erreur de sommation: ' . $erreur->getMessage();
                }
                echo $this->_montant . ' Ariary';
                
        }
    


}
//$objetEnvoi = new Envoyer('V002', 'Piano', 'bmw', 'ZOE@gmail.com', '2024-02-20 10:13:40', 8000, 'Toavina', '0343342710');
//$objetEnvoi->recetteTotale();
//echo "\n Le montant vaut: ". $objetEnvoi->_montant;

?>