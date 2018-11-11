<?php
//Require main config file.
require_once("functions.php");

$opinion = "";
$newOpinion = "";
$productID = "";




if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['logged_in'])){
	

if(isset($_POST['editor2'])){

	$opinion = $_POST['editor2'];
	$UserID = $_SESSION['userID'];
    $productID = $_POST['ProductID'];


	if(empty($error)){
        $newFeedback = DB::insert("tbltestimonials",
        array(
        	'UserID' => $_SESSION['userID'],
            'ProductID' => $productID, 
            'Testimonial' => $opinion 
            )
        );

   header("location: product_detail.php?ProductID=$productID");


}
}

}


?>