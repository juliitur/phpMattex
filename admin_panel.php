<?php
//Require main config file.
require_once("functions.php");

// holders for the values in our database:
$error = array();
$numSpotlight =  count($productSpotlight);
$numProductList = count($productList);
$newProduct = "";

// Pull all user data:
$users = DB::query("SELECT * FROM tblclients");

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['user']) && is_numeric($_POST['user'])){
    if(isset($_POST['edit']) && $_POST['edit'] == "Edit user"){

        if(!empty($user)){
            // USER SETTINGS
            // Catch any errors
            if(isset($_POST['email']) && !empty($_POST['email'])? $newEmail = $_POST['email'] : $error[] = "You failed to enter an email address.");
            if(isset($_POST['password']) && !empty($_POST['password'] && ($_POST['password'] == $_POST['password2']))? $newPassword = $_POST['password'] : $error[] = "You failed to enter a valid password");
    
            if(empty($error)){
                DB::update("tblclients",
                    array(
                      'Email'=>$newEmail,
                      'Password'=>$newPassword
                    ), "UserID=%i", $user
                );
    
                // Reload page
                 header("location: admin_panel.php");
            }else{
                // print_r($error);
            }
        }
    }
}

// // Search functions:
// // Draw an array with just the users email:
// $people = array();
// foreach($people as $i=>$users){
//     $people['id'] = $users[$i]['UserID'];
//     $people['email'] = $users[$i]['Email'];
// }

// // Get query string:
// if(isset($_REQUEST['searchName'])){
//     $email = $_REQUEST['searchName'];
//     $suggestion = "";

//     $email = strtolower($email);
//     $len = strlen($email);

//     foreach($person as $i=>$people){
//         if(stristr($email, substr($people['email'], 0, $len))){
//             if(empty($suggestion)){
//                 $suggestion['email'] = $person['email'];
//                 $suggestion['id'] = $person['id'];
//             }else{
//                 $suggestion[$i]['email'] = $person['email'];
//                 $suggestion[$i]['id'] = $person['id'];
//             }
//         }
//     }
//     echo print_r($suggestion);
// }



if($_SERVER['REQUEST_METHOD'] == "POST"  && isset($_GET['action']) && $_GET['action'] == "newProduct"){
    //New Product
    if(isset($_POST['productName']) && empty($_POST['productName']) ? $error[] = "You haven't entered a product name." : $productName = $_POST['productName']);
    if(isset($_POST['productPrice']) && empty($_POST['productPrice']) ? $error[] = "You haven't entered a product price." : $productPrice = $_POST['productPrice']);
    if(isset($_POST['productDescription']) && empty($_POST['productDescription']) ? $error[] = "You haven't entered a product dexcription." : $productDescription = $_POST['productDescription']);

    //Send new product data
    if(empty($error)){
        $newProduct = DB::insert("tblproducts",
        array(
            'ProductName' => $productName,
            'ProductPrice' => $productPrice,
            'ProductDescription' => $productDescription
            )
        );
    // Reload page
    header("location: admin_panel.php");
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST"  && isset($_GET['action']) && $_GET['action'] == "config"){
    // CONFIG SETTINGS
    // Catch any errors
    if(isset($_POST['productSpotlight']) && !empty($_POST['productSpotlight'])? $numSpotlight = $_POST['productSpotlight'] : $error[] = "You must enter a numeric value for the Product Spotlight field.");
    if(isset($_POST['productList']) && !empty($_POST['productList'])? $numProductList = $_POST['productList'] : $error[] = "You must enter a numeric value for the Product List field.");



    // Upload changes:
    if(empty($error)){
        DB::update("tblconfig",
            array(
                "ProductsDisplayed"=>$numProductList,
                "indexSpotlight"=>$numSpotlight
            ), 1
        );

        // Reload page
        header("location: admin_panel.php");
    }else{
        // print_r($error);
    }
}

//Delete user:
if(isset($_GET['action']) && $_GET['action'] == "delete"){
    if(!empty($user)){
        $sql = DB::delete("tbluser", "UserID=%i" , $user);
    }
}

//render the file when setup is complete.
echo $twig->render('admin_panel.html',
    array(
        "numSpotlight"=>$numSpotlight,
        "numProductList"=>$numProductList,
        "userList"=>$users,
        "newProduct"=>$newProduct,
        "products"=>$products,
        "error"=>$error
        )
    );
?>
