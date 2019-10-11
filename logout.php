<?php
$sessions = include './sessions.txt';
$csrf_tokens = include './tokens.txt';

session_start();

if(isset($_COOKIE['session_id']) and isset($_SESSION['username'])){
	session_unset();
	session_destroy();
    unset($csrf_tokens[$_COOKIE["session_id"]]);
    setcookie('session_id', '', time() + (86400 * 30), "/");
    file_put_contents('./sessions.txt',  '<?php return ' . var_export($sessions, true) . ';');
    file_put_contents('./tokens.txt',  '<?php return ' . var_export($csrf_tokens, true) . ';');    
}
header("location: ./loginpage.php");
?>