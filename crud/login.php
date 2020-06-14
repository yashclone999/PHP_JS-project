<?php
	session_start();
	if( isset($_POST["account"]) && isset($_POST["pass"]) ){

		unset($_SESSION["account"]);
		unset($_SESSION["error"]);
		unset($_SESSION["success"]);

		//Could perform a database check here of account name and password,
		//also add SALT to password.
		if($_POST['pass'] == "password" ){
			$_SESSION["success"] = 'Logged In!';
			$_SESSION["account"] = $_POST["account"];
			header('Location: index.php');
			return;
		}
		else{
			$_SESSION['error'] = 'Incorrect password!';
			header('Location: login.php');
			return;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<script type="text/javascript" src="jquery-3.5.1.min.js"></script>
</head>
<body style="padding: 60px 30px;
  ">
	<h1 style="text-align: center;">Login Page</h1>
	<?php
		if( isset($_SESSION['error']) ){
			echo nl2br( '<p style="color:red">'.$_SESSION['error']."</p>\n" );
			unset($_SESSION['error']);
		}
		if( isset($_SESSION['success']) ){
			echo nl2br( '<p style="color:green">'.$_SESSION['success']."</p>\n" );
			unset($_SESSION['success']);
		}


	?>
	
	<br>
	<hr>
	<form method="POST">
		<p>

			<label for="account">Account name: </label>
			<input type="text"  id = "account" name="account">
			<hr>
			<label for="pass">Password: </label>
			<input type="text"  id = "pass" name='pass'>
			<hr>
			<button type="submit" onclick="return validate();"> LOG IN </button>
			<a href="index.php">Escape</a>
		</p> 
	</form>

	<script type="text/javascript">
		function validate(){
			var acc = document.getElementById('account').value;
			var pas = document.getElementById('pass').value;
			if( !acc || !pas ){
				console.log("Credentials seems fishy!");
				alert("Credentials seems fishy!");
				return false;
			}
			//password cant be checked here since its needs to be checked from database.
			return true;
		}
	</script>

	<script type="text/javascript">
		$(document).ready(
			function(){
				alert("Jquery hi!");
			}
		)
		$(window).resize(
			function(){
				alert("Window resized! "+ $(window).height() );
			}
		)
	</script>
</body>
</html>