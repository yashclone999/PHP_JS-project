<?php
	require_once "connect.php";
	require_once "bootstrap.php";
	session_start();

	if( !isset($_SESSION['account']) ){
		echo nl2br( '<span style=" color:red">LOG IN FIRST :</span> &nbsp' );
			die("LogIn!!");
		}
		

	if( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['id'])  ){

		

		//using placeholder for SQL injection
		$add_sql = 'INSERT INTO users (user_id, name, email, password) VALUES( :id, :name, :email, :pass) ' ;
		$stmt = $pdo->prepare($add_sql);
		$stmt->execute(array(
			':id' => $_POST['id']+0,
			':name' => $_POST['name'],
			':email' => $_POST['email'],
			':pass' => $_POST['password']
		)
		);

		$_SESSION['success'] = "New entry made!" ;
		header("Location: index.php");
		return;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>add</title>
</head>
<body style="padding: 60px 30px;
  ">
	<?php  
	if ( isset($_SESSION['error']) ) {
    	echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    	unset($_SESSION['error']);
	}
	?>

	<h1>Add new entry</h1><br>
	<h2 style='color:blue;'> Welcome <?= htmlentities($_SESSION['account']) ?></h2><hr>
	<p>
		<form method="POST">
			<label for = "id1">User_id:    </label>
			<input type="text" name="id" id = "id1">
			<hr>

			<label for = "id2">NAME:    </label>
			<input type="text" name="name" id = "id2">
			<hr>

			<label for = "id3">E-mail:    </label>
			<input type="text" name="email" id = "id3">
			<hr>

			<label for = "id4">Password:    </label>
			<input type="text" name="password" id = "id4">
			<hr>
			
			<button type="submit" onclick="return validate();"> ADD NEW </button>
		</form>
	</p>

	<a href="index.php">Escape</a>

			
	
	<script type="text/javascript">
		function validate(){
			var uid = document.getElementById('id1').value;
			var name = document.getElementById('id2').value;
			var email = document.getElementById('id3').value;
			var pass = document.getElementById('id4').value;

			// Data validation

			if( !uid || !pass || !name || !email ){
				console.log("Credentials seems fishy!");
				alert("Credentials Missing!");
				return false;
			}

			if( ! email.includes('@') ){
				console.log("Credentials seems fishy!");
				alert("Bad data!");
				return false;
			}

			if( typeof(uid) != 'number' ){
				console.log("Credentials seems fishy!");
				alert("Bad data!");
				return false;
			}
			
    		return true;
		}
	</script>
</body>
</html>

