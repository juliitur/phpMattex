<?php 

	require_once("functions.php");
	$dbProduct = "";





    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $errors = array();    //Empty array to store any errors.

      //Check that the user completed the form.
      if(empty($_POST['productPrice']) ? $errors[] = "You haven't entered a product price." : $productPrice = $_POST['productPrice']);
      if(empty($_POST['productQuantity']) ? $errors[] = "You haven't entered a product price." : $productQuantity = $_POST['productQuantity']);
      $productID = $_POST['selProducts'];
     // if(empty($_POST['productImage']) ? $errors[] = "You haven't upload a product image." : $productImage = $_POST['productImage']);
print_r($products);

      if(empty($errors) == TRUE){
        //Send data

        $dbProduct = DB:: query("UPDATE tblproducts SET QuantityInStock = QuantityInStock + $productQuantity, productPrice = $productPrice WHERE productID = %i", $productID);
         // $dbProduct =  DB::update("tblproducts",
         //        array(
         //          'QuantityInStock'=>$productQuantity,
         //          'productPrice'=>$productPrice,
         //        ), "productID=%i", $productID
         //    );



        header("location: admin_panel.php");


      }else{
        //If there were errors then display them instead of connecting to the server.
        print_r($errors);
      }
    }


















	echo $twig->render('invoice.html', 
    array(
    	"products"=>$products,
    	"dbProduct"=>$dbProduct
        )
    );


 ?>