<?php
require_once("functions.php");

/*
echo "<pre>";

var_dump($_SESSION['cart']);
*/
// echo "</pre>";
if(!isset($_GET['product_id'])) {
    echo $twig->render('product_not_found.html',
        array("products" => $products)
    );
} else {
    $product_id = $_GET['product_id'];

    $product = DB::queryFirstRow("select * from tblproducts where ProductID = %i", $product_id);
    $product['ProductName'] = str_replace("_", " ", ucfirst($product['ProductName']));


    if ($product != null){

        // if product is not in the cart, add it
        if(!isset($_SESSION['cart'][$product_id]))
            $_SESSION['cart'][$product_id] = array(
                'product_id' => $product['ProductID'],
                'description' => $product['ProductName'],
                'unit_price' => $product['ProductPrice'],
                'quantity' => 1,
                'sub_total' => $product['ProductPrice']
            );

        header("Location: cart.php");
    }
    else{
        echo $twig->render('product_not_found.html',
            array("products" => $products)
        );
    }
}
