<?php
//Require main config file.
require_once("functions.php");

$numSpotlight =  count($productSpotlight); 

//render the file when setup is complete.
echo $twig->render('index.html', 
    array(
        "numSpotlight"=>$numSpotlight
        )
    );
?>