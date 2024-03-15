<?php
require "./connexion.php"; 

class Gerant
{
    private $connexion_db;
    private $_emailGerant;
    private $_mdpGerant;
    private $_loginBoolean = false;

    public function __construct($emailInput, $mdpInput )
        {
            $this->connexion_db = NULL;

            $this->_emailGerant = $emailInput;
            $this->_mdpGerant = $mdpInput;

            $this->connexion_db =  new Class_connexion('colis_express', 'localhost', 'root', '');
        }

    public function inscriptionGerant()
        {
            
            try
                {   
                    $pdo_stat = $this->connexion_db->conn ->prepare('INSERT INTO gerant(emailGerant,mdpGerant) values(?,?)');
                    $pdo_stat->execute([$this->_emailGerant, $this->_mdpGerant]);  

                    $row = pdo_stat->fetchAll();

                    return $row;
                        
                }
            catch (PDOException $error)
                {
                  
                    if($error->getCode() == 23000)
                    {
                        echo 'Email déjà existant';
                    }
                    //else echo 'Erreur d\'inscription: ' . $error->getMessage();
                }
        }

     public function connexionGerant()
        {
            
            try
                {   
                    $pdo_stat = $this->connexion_db->conn ->prepare('SELECT * FROM gerant WHERE emailGerant = ? AND mdpGerant = ?');
                    $pdo_stat->execute([$this->_emailGerant, $this->_mdpGerant]);

                    if ($row = $pdo_stat->fetchAll(PDO::FETCH_ASSOC))
                        {
                                $this->_loginBoolean = true;
                                return $this->_loginBoolean;
                        }
                    else return false;
                    
                        
                }
            catch (PDOException $error)
                {
                    echo 'Erreur de connexion: ' . $error->getMessage();
                }
        }

}
/*
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['btn_inscription']))
        {
                if(!empty($_POST['email_inscription']) AND !empty($_POST['mdp_inscription']))
                {
                    $gerant1 = new Gerant($_POST['email_inscription'], $_POST['mdp_inscription']);
                
                    header('Content-Type: application/json');
                    echo json_encode( $gerant1->inscriptionGerant());
                    exit;
                }
            
        }

}

if(isset($_POST['btn_connexion']))
{
        if(!empty($_POST['email']) AND !empty($_POST['mdp']))
        {
            $gerant1 = new Gerant($_POST['email'], $_POST['mdp']);
            echo json_encode($gerant1->connexionGerant());
        }
        
}
*/
?>