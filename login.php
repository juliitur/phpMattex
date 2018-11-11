<?php
//Require main config file.
require_once("functions.php");
//Check for errors with form.
$error = array();

if(isset($_GET['email']) && !empty($_GET['email']) ? $email = $_GET['email'] : $email = "");

if($_SERVER['REQUEST_METHOD'] == "POST"){

    //Check email:
    if(isset($_POST['email']) && !empty($_POST['email'])){
        $email = $_POST['email'];

        //Get account data.
        $accountData = DB::queryFirstRow("SELECT * FROM tblclients WHERE Email=%s", $email);

        //Check if we pulled an account:
        if(!isset($accountData) && empty($accountData)){
            $error[] = "No account found with that email.";
        }

    }else{
        $error[] = "You must enter an email address.";
    }

    //Check password:
    if(isset($_POST['password']) && !empty($_POST['password'])){
        $password = md5($_POST['password']);

        //Check to see if the passwords match.
        if($accountData['Password'] != $password){
            $error[] = "You must enter the correct password for this account.";
        }

    }else{
        $error[] = "You must enter a password.";
    }

    // Error check:
    if(empty($error)){
        // loggin successful.
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['userID'] = $accountData['UserID'];
        $_SESSION['firstName'] = $accountData['UserFirstName'];
        $_SESSION['lastName'] = $accountData['UserLastName'];
        $_SESSION['middleName'] = $accountData['UserMiddleName'];
        $_SESSION['companyName'] = $accountData['CompanyName'];
        $_SESSION['address'] = $accountData['Address'];
        $_SESSION['city'] = $accountData['City'];
        $_SESSION['country'] = $accountData['Country'];
        $_SESSION['state'] = $accountData['Address'];
        $_SESSION['zip'] = $accountData['ZIP'];
        $_SESSION['phone'] = $accountData['Phone'];
        $_SESSION['cellPhone'] = $accountData['CellPhone'];
        $_SESSION['accountType'] = $accountData['AccountType'];


        

        // redirect to order form
        if($_SESSION['accountType'] == 0){
            header("location: admin_panel.php");
        }else{
            header("location: index.php");
        }
        
    }else{
        // print_r($error);
    }


}

//render the file when setup is complete.
echo $twig->render('login.html', 
    array(
        "user"=>$email,
        "error"=>$error
        )
    );
?>