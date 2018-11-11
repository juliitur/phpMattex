<?php
session_start();
//Require the autoload for twig.
require_once("vendor/autoload.php");
//Include the database framework meekro.
include_once("vendor/sergeytsalkov/meekrodb/db.class.php");
//Connect to the database:
DB::$user = "root";
DB::$password = "root";
DB::$dbName = "mattex";

//setup the location of the templates
$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);

$logged_in = FALSE;
//check if sessions logged in.
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE){
    //User is logged in.
    $logged_in = TRUE;
    $twig->addGlobal("email", $_SESSION['email']);
    $twig->addGlobal("userID", $_SESSION['userID']);
    $twig->addGlobal("firstName", $_SESSION['firstName']);
    $twig->addGlobal("lastName", $_SESSION['lastName']);
    $twig->addGlobal("middleName", $_SESSION['middleName']);
    $twig->addGlobal("companyName", $_SESSION['companyName']);
    $twig->addGlobal("address", $_SESSION['address']);
    $twig->addGlobal("city", $_SESSION['city']);
    $twig->addGlobal("country", $_SESSION['country']);
    $twig->addGlobal("state", $_SESSION['state']);
    $twig->addGlobal("zip", $_SESSION['zip']);
    $twig->addGlobal("phone", $_SESSION['phone']);
    $twig->addGlobal("cellPhone", $_SESSION['cellPhone']);
    $twig->addGlobal("accountType", $_SESSION['accountType']);
}
$twig->addGlobal("logged_in", $logged_in); // Add a super global so that we dont have to send it to each template.

//Get the current page
$url = $_SERVER['PHP_SELF'];
$twig -> addGlobal("url", $url);

// run sql to get newsletter
$newsletters = DB::query("SELECT * FROM tblnewsletter");

//run sql to get the name of all the products
$products = DB::query("SELECT * FROM tblproducts");

//run sql to get the config settings:
$pullConfig = DB::queryFirstRow("SELECT * FROM tblconfig");

//Get the number of products to be shown.
$productsDisplayed = $pullConfig['ProductsDisplayed'];
$indexSpotlight = $pullConfig['indexSpotlight'];

//Add an item to the end of the array.
foreach($products as $i=>$product){
    $products[$i]['cleanName'] = str_replace("_", " ", ucfirst($product['ProductName']));
}

//Construct a list of all the product names to be shown.
$productSpotlight = array();
for($count = 0; $count < $indexSpotlight; $count++){
    $productSpotlight[$count]['cleanName'] = $products[$count]['cleanName'];
    $productSpotlight[$count]['ProductName'] = $products[$count]['ProductName'];
    $productSpotlight[$count]['ProductDescription'] = $products[$count]['ProductDescription'];
    $productSpotlight[$count]['ProductID'] = $products[$count]['ProductID'];
}


//Get the product list:
$productList = array();
for($count = 0; $count < $productsDisplayed; $count++){
    $productList[$count]['cleanName'] = $products[$count]['cleanName'];
    $productList[$count]['ProductName'] = $products[$count]['ProductName'];
    $productList[$count]['ProductID'] = $products[$count]['ProductID'];
    $productList[$count]['ProductImg'] = 1;
}

//Check to see if there are products missing from the dropdown menu.
if(count($productList) != count($products)){
    $lastEntry = count($productList) + 1;
    $productList[$lastEntry]['ProductID'] = 'All';
    $productList[$lastEntry]['cleanName'] = 'Other products...';
    $productList[$lastEntry]['ProductName'] = 'products';
    $productList[$lastEntry]['ProductImg'] = "";
}

$twig -> addGlobal("products", $products); 
$twig -> addGlobal("prodlist", $productList);   //Send the items that will be in the drop down list.
$twig -> addGlobal("productSpotlight", $productSpotlight);   //Send the item details that will be in the product spotlight section.


?>
