<?php
//Require main config file.
require_once("functions.php");

if(isset($_SESSION['cart'])? $cart = $_SESSION['cart'] : $cart = "");
$total = 0;
$countitems = 0;

if(!empty($_SESSION['cart'])){
    foreach($cart as $item) {
    $subtotal = $item['sub_total'];
        $total = $total+$subtotal;
        $countitems = $countitems+$item['quantity'];
    }
}

//run sql to get the information of the client
if(isset($_SESSION['userID']) && !empty($_SESSION['userID']) && is_numeric($_SESSION['userID']))
$client = DB::queryFirstRow("SELECT * FROM tblclients WHERE UserID =%i", $_SESSION['userID']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // // Reload page
    header("location: index.php");
}

//render the file when setup is complete.
echo $twig->render('payment_form.html',
    array(
        "products"=>$products,
        "cart" => $cart,
        "total" => $total,
        "quantity" => $countitems,
        "client" => $client
    )
);
?>
