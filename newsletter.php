<?php
//Require main config file.
require_once("functions.php");

$cart = $_SESSION['cart'];

//render the file when setup is complete.
echo $twig->render('index.html',
    array(
        "products"=>$products,
        "cart" => $cart
    )
);
?>
