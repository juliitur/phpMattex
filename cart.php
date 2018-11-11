<?php
//Require main config file.
require_once("functions.php");

if(isset($_SESSION['cart'])? $cart = $_SESSION['cart']: $cart= "");

//render the file when setup is complete.
echo $twig->render('cart.html',
    array(
        "products"=>$products,
        "cart" => $cart
    )
);
?>
