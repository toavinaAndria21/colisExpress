<?php

require "./tcpdf/tcpdf.php"; //inclusion de la bibliothèque nécessaire à la création de pdf;

//require "./envoyer.php";
require "./lastSenderId.php";

class genererPdf

        {

        private $recuEnpdf; //variable qui contiendra le pdf
        private $connexion_db;
        private $_idEnvoi;
        private $objetEnvoyeur;

        private $_dateEnvoi; 
        private $_nomEnvoyeur; 
        private $_idVoit;
        private $_villeDep;
        private $_villeArr;
        private $_nomColis; 
        private $_frais; 
        private $_nomRecept; 
        private $_contactRecept;
        private $_codeIt;
        private $_email; 
    
        
    public function __construct($email=NULL, $codeIt=NULL)
      {
        $this->_email = $email;
        $this->_codeIt = $codeIt;
      }

               
     //fonction qui recupere les donnees necessaires au remplissage du pdf;   
    public function recupererDonneeEnvoyeur()
            {   
                //creation d'une instance de la class Envoyer pour pouvoir utiliser la methode recupererDernierIdEnvoyer();
              //  $this->objetEnvoyeur = new Envoyer('V002', 'Piano', 'bmw', 'gentlemantoavina@gmail.com', '2024-02-20 10:13:40', 8000, 'Toavina', '0343342710');
              //  $this->_idEnvoi = $this->objetEnvoyeur->recupererDernierIdEnvoyer();
              $this->connexion_db =  new Class_connexion('colis_express', 'localhost', 'root', '');

              $this->_idEnvoi = getLastSenderId($this->_email);
                 //recuperation de la date d'envoi;
                 $this->selectFromTable('date_Envoi', 'envoyer', $this->_dateEnvoi);
                
                //recuperation du nom de l'envoyeur;
                $this->selectFromTable('nomEnvoyeur', 'envoyer', $this->_nomEnvoyeur);
                
                //recuperation du colis de l'envoyeur;
                $this->selectFromTable('colis', 'envoyer', $this->_nomColis);

                //recuperation du frais de l'envoyeur;
                $this->selectFromTable('frais', 'envoyer', $this->_frais);

                //recuperation du nom du recpteur;
                $this->selectFromTable('nomRecepteur', 'envoyer', $this->_nomRecept);

                 //recuperation du contact du recpteur;
                 $this->selectFromTable('contactRecepteur', 'envoyer', $this->_contactRecept);

                  //recuperation de l' idVoiture du recpteur;
                $this->selectFromTable('idVoit', 'envoyer', $this->_idVoit);

                //recuperation de l'itineraire du colis;
             /*   $pdo_stat = $this->connexion_db->conn->prepare('SELECT codeIt FROM voiture WHERE idVoit = ?');
                $pdo_stat->execute([$this->_idVoit]);
                $row = $pdo_stat->fetch(PDO::FETCH_ASSOC);
                $this->_codeIt = $row['codeIt']; */

                 //recuoeration du ville depart et ville d'arriver;
                $pdo_stat = $this->connexion_db->conn->prepare('SELECT villeDep, villeArr FROM itineraire WHERE codeIt = ?');
                $pdo_stat->execute([$this->_codeIt]);
                $row = $pdo_stat->fetch(PDO::FETCH_ASSOC);
                $this->_villeDep = $row['villeDep'];
                $this->_villeArr = $row['villeArr'];
               
             
                  
            }

    public function selectFromTable($nomColonne, $nomTable, &$varibaleDeLaClass)
            {
                try
                    {
                        $pdo_stat = $this->connexion_db->conn->prepare('SELECT ' . $nomColonne . ' FROM ' . $nomTable . ' WHERE idEnvoi = ?');
                        $pdo_stat->execute([$this->_idEnvoi]);
                        $row = $pdo_stat->fetch(PDO::FETCH_ASSOC);
                        $varibaleDeLaClass = $row[$nomColonne];
         
                    }
                catch(PDOException $erreur)
                    {
                        echo'Erreur lors de la requete: ' . $erreur->getMessage();
                    }    
                
            } 


    //fonction qui permet d'écrire dans un pdf  
    public function writeInPdf($pdf, $text, $xPosition, $yPosition, $textWidth, $textHeight, $border = 0, $endLine = 0, $textAlign = 'C', $fill = false, $font = 'Arial', $fontStyle = '', $fontSize = 12, $textColor = [0,0,0], $backgroundColor = [255, 255, 255])
            {
                    $pdf->SetFont($font, $fontStyle, $fontSize);
                    $pdf->setTextColor($textColor[0], $textColor[1], $textColor[2]);
                    $pdf->setFillColor($backgroundColor[0], $backgroundColor[1], $backgroundColor[2]);
                    $pdf->SetXY($xPosition, $yPosition);
                    $pdf->Cell( $textWidth, $textHeight, $text, $border, $endLine, $textAlign, $fill );
            }    
    
    //fonction qui permet de créer un pdf   
    public function outputPdf()
            
            {
                try
                {   
                    $this->recupererDonneeEnvoyeur();

                    $this->recuEnpdf = new TCPDF(); //creation d'une instance de la classe TCPDF;
                
                    $this->recuEnpdf->AddPage();//ajout d'une nouvelle page vide;
                    
                    //appel de la fonction qui permet d'écrire dans le pdf;
                    $this-> writeInPdf($this->recuEnpdf, 'Reçu N° :', 85, 10, 180, 10, 0, 0, 'L', false, 'times', 'I', 16, [0,0,0], [255,255,255]);
                    $this-> writeInPdf($this->recuEnpdf, 'Date d\'envoi                      :   ' . $this->_dateEnvoi, 50, 25, 180, 10, 0, 0, 'L', false, 'times', '', 14, [0,0,0], [255,255,255]);
                    $this-> writeInPdf($this->recuEnpdf, 'Nom  de l\'envoyeur           :   ' . $this->_nomEnvoyeur, 50, 35, 180, 10, 0, 0, 'L', false, 'times', '', 14, [0,0,0], [255,255,255]);
                    $this-> writeInPdf($this->recuEnpdf, 'Voiture N°' . $this->_idVoit . ' \\ Destination :   ' . $this->_villeDep . ' - ' . $this->_villeArr, 50, 45, 180, 10, 0, 0, 'L', false, 'times', '', 14, [0,0,0], [255,255,255]);
                    $this-> writeInPdf($this->recuEnpdf, 'Colis                                  :   ' . $this->_nomColis, 50, 55, 180, 10, 0, 0, 'L', false, 'times', '', 14, [0,0,0], [255,255,255]);
                    $this-> writeInPdf($this->recuEnpdf, 'Frais                                  :   ' . $this->_frais . ' Ariary', 50, 65, 180, 10, 0, 0, 'L', false, 'times', '', 14, [0,0,0], [255,255,255]);
                    $this-> writeInPdf($this->recuEnpdf, 'Nom  du récepteur            :   ' . $this->_nomRecept, 50, 75, 180, 10, 0, 0, 'L', false, 'times', '', 14, [0,0,0], [255,255,255]);
                    $this-> writeInPdf($this->recuEnpdf, 'Contact  du récepteur       :   ' . $this->_contactRecept, 50, 85, 180, 10, 0, 0, 'L', false, 'times', '', 14, [0,0,0], [255,255,255]);

                    //Exécution de la crréation de pdf;
                    //le 1er parmetre est le repetoire de stockage du pdf créé
                    // 'F' indique que le fichier pdf dera enregistré sur le serveur utilisé (Autres valeurs possibles: I, D, S); 
                    $this->recuEnpdf->Output('D:/PROJETS/PHP/ColisExpress/reçu.pdf', 'F');
                    echo "Le fichier PDF a été généré avec succès." ;
                    
                }

            catch(PDOException $e)

                {
                echo 'Erreur de création du fichier pdf :' . $e->getMessage();
                }

            }  

    }

$emailAndCodeITFromJs = json_decode(file_get_contents("php://input"), true);
//echo $emailFromJs;
$pdf = new genererPdf($emailAndCodeITFromJs[0], $emailAndCodeITFromJs[1]);
$pdf->outputPdf();









?>