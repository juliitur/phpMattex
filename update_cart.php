<?php
//Require main config file.
require_once("functions.php");

foreach($_SESSION['cart'] as $product_id => $item) {

$newquantity = $_POST['quantity'][$product_id];

$_SESSION['cart'][$product_id]["quantity"]= $newquantity;
$_SESSION['cart'][$product_id]["sub_total"]= $item['unit_price']*$newquantity;

}

header("Location: cart.php");
