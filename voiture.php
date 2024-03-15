<?php

require "./connexion.php"; 

class Voiture 
{
    public $_idVoiture;
    public $_designVoiture;
    public $_frais;
    private $connexion_db;
    private $pdo_stat;
    private $_codeIt;


    public function __construct($id_voiture, $design_voiture, $code_it, $frais_voiture, $id_envoi)
        {
            $this->connexion_db = NULL;

            $this->_idVoiture = $id_voiture;
            $this->_designVoiture = $design_voiture;
            $this->_frais = $frais_voiture;
            $this->_codeIt = $code_it;
            $this->id_envoyeur = $id_envoi;

            $this->connexion_db =  new Class_connexion('colis_express', 'localhost', 'root', '');
        }

    public function insererVoiture()
        {
            $pdo_stat = $this->connexion_db->conn -> prepare('INSERT INTO voiture VALUES (?,?,?,?)');
            $pdo_stat->execute([$this->_idVoiture, $this->_designVoiture, $this->_codeIt, $this->_frais]);
        }
    
    public function updateVoiture()
        {
            $pdo_stat = $this->connexion_db->conn->prepare('UPDATE voiture SET design = ?, frais = ?  WHERE idVoit IN (SELECT idVoit FROM envoyer WHERE idEnvoi= ?);');
            $pdo_stat->execute([ $this->_designVoiture, $this->_frais, $this->id_envoyeur]);
        }
    
    public function deleteVoiture()
        {
            $pdo_stat=$this->connexion_db->conn->prepare('DELETE FROM voiture WHERE idVoit = ? ');
            $pdo_stat->execute([$this->_idVoiture ]);
        }

    public function readVoiture()
        {
            $pdo_stat=$this->connexion_db->conn->prepare('SELECT * FROM voiture');
            $pdo_stat->execute();
        }

    
    
}
$objettest = new Voiture('V005', 'Toot', 'akondro', '700', '1');
$objettest->insererVoiture();












?>