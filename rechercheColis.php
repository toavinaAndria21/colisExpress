<?php

require "./connexion.php"; 

class RechercheColis
  {
    private $connexion_db;
    private $_inputValue;
    private $_firstDateValue;
    private $_secondDateValue;
    
    public function __construct($inputValue, $firstDateValue=NULL, $secondDateValue=NULL)
        {  
            try
               {
                    $this->connexion_db = NULL;
                    $this->_inputValue = $inputValue;
                    $this->_firstDateValue = $firstDateValue;
                    $this->_secondDateValue = $secondDateValue;

                    $this->connexion_db =  new Class_connexion('colis_express', 'localhost', 'root', '');
                }
            catch(PDOException $erreur)
                {
                    echo 'Erreur de recherche: ' . $erreur->getMessage();
                }     
        }

    public function rechercheDesignation()
        {
            try
                {
                    $pdo_stat = $this->connexion_db->conn->prepare('SELECT idEnvoi, nomEnvoyeur, emailEnvoyeur, colis FROM envoyer WHERE colis LIKE ? OR idEnvoi LIKE ?');
                    $pdo_stat->execute(["%".$this->_inputValue."%", "%".$this->_inputValue."%"]);

                    $row = $pdo_stat->fetchAll(PDO::FETCH_ASSOC);

                    return $row;
                
                }
            catch(PDOException $erreur)
                {
                    echo 'Erreur de recherche: ' . $erreur->getMessage();
                }      
            
        }

    public function rechercheDates()
        {
            try
                {
                    $pdo_stat = $this->connexion_db->conn->prepare('SELECT idEnvoi, nomEnvoyeur, emailEnvoyeur, colis FROM envoyer WHERE date_Envoi >= ? AND date_Envoi <= ?');
                    $pdo_stat->execute([$this->_firstDateValue, $this->_secondDateValue]);
                    
                    $row = $pdo_stat->fetchAll(PDO::FETCH_ASSOC);

                    return $row;

                }
                catch(PDOException $erreur)
                {
                    echo 'Erreur de recherche: ' . $erreur->getMessage();
                }
        }    
    
  }



?>