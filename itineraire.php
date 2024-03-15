<?php
 
require "./connexion.php"; 

class itineraire{

    private $connexion_db;
  
    public $_codeIT;
    public $_villeDep;
    public $_villeArr;
    
   
    

public function __construct($codeit = NULL, $villeDep = NULL, $villeArr = NULL)
      {
    
     
    $this->connexion_db = NULL;

        $this->_codeIT = $codeit;
        $this->_villeDep = $villeDep;
        $this->_villeArr = $villeArr;
    
    $this->connexion_db =  new Class_connexion('colis_express', 'localhost', 'root', '');
   
         
      }
    
public function insererItineraire()
      {
        try
          {
             $pdo_stat = $this->connexion_db->conn -> prepare('INSERT INTO itineraire VALUES (?,?,?)');
             $pdo_stat->execute([ $this->_codeIT, $this->_villeDep, $this->_villeArr]);
          }
        catch (PDOException $error)
          {
                echo 'Erreur d\'ajout d\'itinéraire : ' . $error->getMessage();
          }
          
      }

 public function updateItineraire()
      {
          
        try
          {   
           $pdo_stat = $this->connexion_db->conn ->prepare('UPDATE itineraire SET villeDep = ?, villeArr = ? WHERE codeIt = ?');
           $pdo_stat->execute([$this->_villeDep, $this->_villeArr, $this->_codeIT]);         
          }
        catch (PDOException $error)
          {
                echo 'Erreur de mise à jour : ' . $error->getMessage();
          }
        // $this->connexion->close();
      }

public function deleteItineraire()
    {
        $pdo_stat = $this->connexion_db->conn->prepare('DELETE FROM itineraire WHERE codeIt = ? ');
     
        $pdo_stat->execute([$this->_codeIT]);
       // $this->connexion->exit();
    }

public function readItineraire()
    {
      try 
      {
        $sql = 'SELECT codeIt FROM itineraire';
        $resultat = $this->connexion_db->conn ->query($sql);
       
       
        $row = $resultat->fetchAll(PDO::FETCH_ASSOC);

        return $row;  

      } 
      catch(PDOException $e)
      {
      echo ('Erreur de listage: ') . $e->getMessage();  
      } 
    } 
    
public function readDestination()
    {
      try 
      {
        $pdo_stat = $this->connexion_db->conn->prepare('SELECT villeDep, villeArr FROM itinearire WHERE codeIt = ?');
        $pdo_stat->execute([$this->_codeIT]);
 
        $row = $pdo_stat->fetch(PDO::FETCH_ASSOC);

        return $row;  

      } 
      catch(PDOException $e)
      {
      echo ('Erreur de recuperation des destinations: ') . $e->getMessage();  
      } 
    }  

}

//$insertion = new itineraire('bolita', 'jeep','arrpi');
//$insertion-> readItineraire();


?>

