<?php
//Require main config file.
require_once("functions.php");
$title = "";
$feedback = "";
$newFeedback = "";
$rating = "";



if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['logged_in'])){
	

if(isset($_POST['title']) && isset($_POST['editor1'])){
	$title = $_POST['title'];
	$feedback = $_POST['editor1'];
	$UserID = $_SESSION['userID'];
	$rating = $_POST['rating'];

	if(empty($error)){
        $newFeedback = DB::insert("tblfeedback",
        array(
        	'UserID' => $_SESSION['userID'],
            'Title' => $title,
            'Message' => $feedback,
            'Rating' => $rating
            )
        );

    header("location: feedback.php");


}
}

}


//render the file when setup is complete.
echo $twig->render('feedback.html', 
    array("newFeedback" => $newFeedback)
    );
?>