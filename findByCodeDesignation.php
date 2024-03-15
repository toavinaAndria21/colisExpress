<?php
require "./rechercheColis.php";

$codeOrDesignation = json_decode(file_get_contents("php://input"), true);

$objetRechercherColis = new RechercheColis($codeOrDesignation[0]);

echo json_encode($objetRechercherColis->rechercheDesignation());

?>