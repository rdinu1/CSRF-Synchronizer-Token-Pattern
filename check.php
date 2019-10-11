<?php
	session_start();
	$csrf_tokens = include './tokens.txt';
	$feedback = include './feedback.txt';

    if(!isset($_POST["feedback"])){
        header("location: ./home.php?error=Please give a feedback !");
    }else{
        if(!isset($_COOKIE['session_id'])) {
            header("location: ./loginpage.php");
        } else {
            if(!isset($_POST["csrf_token"])){
                header("location: ./loginpage.php?error=Failed! Please login and try again!");
            }else{
                // Validate the stored csrf token and the token sent by the client
                if($_POST["csrf_token"] == $csrf_tokens[$_COOKIE['session_id']]){
                    $feedback[$_SESSION['username']] = $_POST["feedback"];
                    file_put_contents('./feedback.txt',  '<?php return ' . var_export($feedback, true) . ';');

                    header("location: ./home.php?success=Your feedback was succuessfully saved !");


                }else{
                    header("location: ./loginpage.php?error=Failed! Please login and try again!!!!");
                }
            }
        }
    }
?>