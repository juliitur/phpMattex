<?php
require_once("functions.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Check Name:
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }

// Check Email:
if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
// check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if(empty($nameErr) && empty($emailErr)){

  $newsletters = DB::insert("tblnewsletter",
  array(
      'name' => $name,
      'email' => $email,
      )
  );

}

// Reload page
 header("location: index.php");
?>
