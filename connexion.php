<?php

class Class_connexion
{
    public  $conn;
    private $db_Name_host_Name;
    private $db_User;
    private $db_PassWord;

    public function __construct($db_name, $host_name, $user, $passWord)
     { 
        $this->db_Name_host_Name = 'mysql:dbname=' . $db_name . ';' . 'host=' . $host_name;
        $this->db_User = $user;
        $this->db_PassWord = $passWord;
        try
        {
         $this->conn=new PDO($this->db_Name_host_Name, $this->db_User, $this->db_PassWord);
         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
     catch(PDOException $error)
        {
         echo 'Erreur de connexion : ' . $error->getMessage();
        }
     }
}
//$test = new Class_connexion('colis_express', 'localhost', 'root', '');

?>