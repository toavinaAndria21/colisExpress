<?php

class Email 
 {
    private $_destinataire; 
    private $_subject; 
    private $_message; 
    private $_headers;
    private $_emailSender;

    public function __construct($destinataire, $subject, $message)
       {
         $this->_destinataire = $destinataire; 
         $this->_subject = $subject; 
         $this->_message = $message; 
        // $this->_emailSender = $emailSender; 
         $this->_headers = "Content-Type: text/plain; charset=utf-8 \r\n";
        // $this->_headers .= "From : " . " .$this->_emailSender ." . "\r\n";
        $this->_headers .= "From: rabezandrinytoavina@gmail.com\r\n";


       }
    
    public function sendEmail()
        {
         try
          {
            if(mail($this->_destinataire,  $this->_subject,  $this->_message,  $this->_headers))
               {
                echo 'Email bien envoyé lesy ehh;)';
               }
            else echo 'Erreur d\'envoi de l\'email !'; 
        
          }
          catch(Exception $e)
          {
            echo "Erreur de la fonction mail()" . $e->getMessage();
          }
              
        }   


 }

$objetEmail = new Email('gentlemantoavina@gmail.com', 'Colis arrivé à déstination !', 'Votre colis est arrivé à destination', 'rabezandrinytoavina@gmail.com');

echo json_encode($objetEmail->sendEmail());   


?>