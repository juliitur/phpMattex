  <?php
  //Require main config file.
  require_once("functions.php");

  $userInfo = "";
  $clientInfo = "";
  $formData = array();
  $errors = array();    //Empty array to store any errors.


    if($_SERVER['REQUEST_METHOD'] == "POST"){

      //Check that the user completed the form.
      if(empty($_POST['firstName']) ? $errors[] = "You haven't entered your first name." : $formData['firstName'] = $firstName = ucwords($_POST['firstName']));
      if(empty($_POST['lastName']) ? $errors[] = "You haven't entered your last name." : $formData['lastName'] = $lastName = ucwords($_POST['lastName']));
      if(empty($_POST['email']) ? $errors[] = "You haven't entered your email." : $formData['email'] = $email = $_POST['email']);
      if(empty($_POST['password']) ? $errors[] = "You haven't entered your password." : $formData['password'] = $password = $_POST['password']);
      if(empty($_POST['address']) ? $errors[] = "You haven't entered your address." : $formData['address'] = $address = $_POST['address']);
      if(empty($_POST['zip']) ? $errors[] = "You haven't entered your zip code." : $formData['zip'] = $zip = $_POST['zip']);
      if(empty($_POST['phone']) ? $errors[] = "You haven't entered your phone number." : $formData['phone'] = $phone = $_POST['phone']);
      if(empty($_POST['cellPhone'])? $errors[] = "You haven't entered your cellphone number." : $formData['cellPhone'] = $cellPhone = $_POST['cellPhone']);
      if(empty($_POST['country'])? $errors[] = "You haven't entered your country." : $formData['country'] = $country = $_POST['country']);
      if(empty($_POST['state'])? $errors[] = "You haven't entered your state." : $formData['state'] = $state = $_POST['state']);
      if(empty($_POST['city'])? $errors[] = "You haven't entered your city." : $formData['city'] = $city = $_POST['city']);

      // Check if any optional fields weren't empty:
      if(isset($_POST['middleName']) ? $formData['middleName'] = $middleName = ucwords($_POST['middleName']) : $middleName = "");
      if(isset($_POST['companyName']) ? $formData['companyName'] = $companyName = ucwords($_POST['companyName']) : $companyName = "");

      // Check for image
      if(isset($_FILES['image']) && !empty($_FILES['image'])){
        if($_FILES['image']['size'] <= 30000){
          $image = addslashes($_FILES['image']['tmp_name']);
          $formData['image'] = $name = addslashes($_FILES['image']['name']);
          if(!empty($image)){
            $image = file_get_contents($image);
            $image = base64_encode($image);
          }
        }else{
          $errors[] = "The image you are trying to upload is over 3MB.";
        }
      }

      
      
      //Check to see if the passwords are the same.
      if(isset($_POST['rePassword']) && !empty($_POST['rePassword']))
      if($_POST['password'] != $_POST['rePassword'] ? $errors[] = "Your passwords do not match." : $password = md5($password));

      if(empty($errors) == TRUE){
        //Send data
        $clientInfo = DB::insert("tblclients", 
        array(
          'Email' => $email,
          'Password' => $password,
          'UserFirstName' => $firstName,
          'UserMiddleName' => $middleName,
          'UserLastName' => $lastName,
          'CompanyName' => $companyName,
          'Address' => $address,
          'City' => $city,
          'Country' => $country,
          'State' => $state,
          'ZIP' => $zip,
          'Phone' => $phone,
          'CellPhone' => $cellPhone,
          'DisplayPicture' => $image,
          'AccountType' => 1
        )
      );




        //Account created, redirect to the login.
        header("location: login.php?email=". $email);

      }else{
        //If there were errors then display them instead of connecting to the server.
        // print_r($errors);
      }
    }


    //render the file when setup is complete.
    echo $twig->render('signup.html', 
    array(
        "userInfo"=>$userInfo,
        "clientInfo"=>$clientInfo,
        "formData"=>$formData,
        "error"=>$errors
        )
    );