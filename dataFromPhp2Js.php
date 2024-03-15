<?php
require"./rechercheEmail.php";

function getDataFromPhpAndSendIt2Js()
    {
        $finalData = getDataFromDataBase();
        return $finalData;
    }
echo json_encode(getDataFromPhpAndSendIt2Js()); //recupere la variable $finalData retourner par la fonction getDataFromDataBase();




?>