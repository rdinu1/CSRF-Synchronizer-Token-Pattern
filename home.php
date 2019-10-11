
<!DOCTYPE html>
<html>
<head>
	 <title>WS CSRF Assignment</title>
	<script src="js/jquery.min.js"></script>
    <!--<script src="js/bootstrap.min.js"></script>-->
    <style>
    form {
	border: 10px solid #f1f1f1;
	width:500px;
	margin-left:400px;
	margin-top:100px;
}
	input[type=text] {
    width: 90%;
    padding: 20px 20px;
    margin: 8px 0;
    border: 1px solid #ccc;  
}

button {
    background-color: #4CAF50;
    //background-color: #4db8ff;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

a {
    color: white;
    margin-left: 410px;
    display: inline-block;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    background-color:#ff3333; 
}

.alert{
    font-size: 30px;
    margin-left: 400px;
    margin-top: 100px;
    color: crimson;
}
    </style>
</head>
<body>
    <?php
    if(isset($_GET['error'])){
        echo '<div class="alert alert-danger" role="alert">'.$_GET['error'].'</div>';                
    }elseif(isset($_GET['success'])){
        echo '<div class="alert alert-success" role="alert">'.$_GET['success'].'</div>';
    }
	
    if(isset($_COOKIE['session_id'])){
		echo "
	<form method='POST' action='check.php' enctype='multipart/form-data'>
		<label for='feedback'><b>Feedback:</b></label><br/>
    		<input type='text' placeholder='Give a feedback' name='feedback' required><br/><br/>

    		<input type='hidden' name='csrf_token' value='' id='csrf_token'>
        
    		<button type='submit' name = 'feedbacksubmit' >Send</button>

    </form>";
	}
	?>

    <a href="./logout.php">Logout </a>

    <script>
    	var request="true";
        $.ajax({
        url:"csrftoken.php",
        method:"POST",
        data:{request:request},
        dataType:"json",
        success:function(data)
        {
            document.getElementById("csrf_token").value=data.token;
        }
        })
    </script>
</body>
</html>