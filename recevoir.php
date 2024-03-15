<?php

require './connexion.php';

class Recevoir
  {
    private $_idRecept;
    private $_idEnvoi;
    private $_date_Recept;

    private $connexion_db;

    public function __construct($idEnvoi, $date_Recept)
        {
            $this->connexion_db = NULL;

            $this->_idEnvoi = $idEnvoi;
            $this->_date_Recept = $date_Recept;

            $this->connexion_db =  new Class_connexion('colis_express', 'localhost', 'root', '');

        }

    public function insererRecept()
        {
            try
                {
                    $pdo_stat = $this->connexion_db->conn -> prepare('INSERT INTO recevoir(idEnvoi, date_Recept) VALUES (?,?)');
                    $pdo_stat->execute([ $this->_idEnvoi, $this->_date_Recept ]); 
                }
            catch (PDOException $error)
                {
                    echo 'Erreur d\'insertion : ' . $error->getMessage();
                }               
        }
    
    public function updateRecept()
        {
            try
            {
                $pdo_stat=$this->connexion_db->conn->prepare('UPDATE recevoir SET date_Recept = ? WHERE idEnvoi = ?');
                $pdo_stat->execute([ $this->_date_Recept, $this->_idEnvoi ]);
            }
            catch(PDOException $error)
            {
                echo 'Erreur de mise à jour : ' . $error->getMessage();
            }
        
        }

    public function deleteRecept()
        {
            try
            {
                $pdo_stat=$this->connexion_db->conn->prepare('DELETE FROM recevoir WHERE idEnvoi = ?');
                $pdo_stat->execute([ $this->_idEnvoi ]);
            }
            catch(PDOException $error)
            {
                echo 'Erreur de suppression : ' . $error->getMessage();
            }
        
        }

    public function readRecept()
        {
            try
            {
                $pdo_stat=$this->connexion_db->conn->prepare('SELECT * FROM recevoir WHERE idEnvoi = ?');
                $pdo_stat->execute([ $this->_idEnvoi ]);
                    while($row = $pdo_stat->fetch(PDO::FETCH_ASSOC))
                        {
                            echo ' : ' . $row['idRecept'] . "  ";
                            echo ' : ' . $row['idEnvoi'] . "  ";
                            echo ' : ' . $row['date_Recept'] . "\n";
                        }
                
            }
            catch(PDOException $error)
            {
                echo 'Erreur de recherche : ' . $error->getMessage();
            }
        }
    
        public function readAllRecept()
        {
            try
            {
                $sql = 'SELECT * FROM recevoir';
                $resultat = $this->connexion_db->conn ->query($sql);
                          
                    while( $row = $resultat->fetch(PDO::FETCH_ASSOC))
                        {
                            echo ' : ' . $row['idRecept'] . "  ";
                            echo ' : ' . $row['idEnvoi'] . "  ";
                            echo ' : ' . $row['date_Recept'] . "\n";
                        }
            
            }
            catch(PDOException $error)
            {
                echo 'Erreur de recherche : ' . $error->getMessage();
            }
        }

  }
$var=new Recevoir(3,'2024-09-20 00:00:00');
$var->readRecept();




?>