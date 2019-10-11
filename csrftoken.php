<?php

	$csrf_tokens = include './tokens.txt';

	//reply to the json request with the CSRF token save in the server side
	if(isset($_POST["request"]))
	{
        	$data["token"] = $csrf_tokens[$_COOKIE['session_id']];
        	echo json_encode($data);
	}
?>