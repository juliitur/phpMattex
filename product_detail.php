<?php
//Require main config file.
require_once("functions.php");

// Get productID form the URL
if(isset($_GET['ProductID']) && !empty($_GET['ProductID'])){
    if($_GET['ProductID'] == "All")
    header('location: products.php');
    if(is_numeric($_GET['ProductID']))
    $productID = $_GET['ProductID'];
}

// Get all the product information
$productInfo = DB::queryFirstRow("SELECT * FROM tblproductspec WHERE ProductID=%i", $productID);

// Get the product names:
$productName = DB::queryFirstRow("SELECT * FROM tblproducts WHERE ProductID=%i", $productID);
$productName['cleanName'] = str_replace("_", " ", ucfirst($productName['ProductName']));

// Get the product testimonials:
$productTestimonials = DB::query("SELECT * FROM tbltestimonials where ProductID=%i", $productID);

// Get the users display picture:
$userDisplay = array();
for($i=0; $i < count($productTestimonials); $i++){
    $userDisplay[] = $productTestimonials[$i]['UserID'];
}

// Get display picture from clients table with UserID from product Testimonials:
$userPicture = array();
for($i=0 ; $i < count($productTestimonials); $i++){
    $pictures = DB::queryFirstRow("SELECT DisplayPicture FROM tblclients WHERE UserID=%i", $userDisplay[$i]);
    $userPicture[] = $pictures['DisplayPicture'];
}
// print_r($userPicture);


for($i=0; $i < count($productTestimonials); $i++){
    $productTestimonials[$i]['picture'] = $userPicture[$i];
}
// print_r($productTestimonials);





//render the file when setup is complete.
echo $twig->render('product_detail.html', 
    array(
        "info"=>$productInfo,
        "product"=>$productName,
        "testimonials"=>$productTestimonials
        )
    );
?>