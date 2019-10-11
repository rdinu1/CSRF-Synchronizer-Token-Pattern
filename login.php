<?php
session_start();

$users = include './users.txt';
$sessions = include './sessions.txt';
$csrf_tokens = include './tokens.txt';

   $username = $_POST['uname'];
   $password = $_POST['pwd'];

       if($users[$username] === $password){
        // Generate session id and csrf token
        $session_id = uniqid();            
        $csrf_token = base64_encode(openssl_random_pseudo_bytes(32));
        $sessions[$username] = $session_id;
        $csrf_tokens[$session_id] = $csrf_token;
        $_SESSION['username'] = $_POST['uname'];

        // Save session and csrf token
        file_put_contents('./sessions.txt',  '<?php return ' . var_export($sessions, true) . ';');
        file_put_contents('./tokens.txt',  '<?php return ' . var_export($csrf_tokens, true) . ';');

        // set session_id cookies
        setcookie('session_id', $session_id, time() + (86400 * 30), "/");
        
        header("location: ./home.php");
       }else{
         header("location: ./loginpage.php?error=Invalid username or password! Please check the credentials and try again!");
       }
?>

