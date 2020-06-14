<?php
	require_once 'connect.php';
	require_once "bootstrap.php";

	if ( ! isset($_GET['user_id']) ) {
			die("    LogIn first!!");	}

	$Stmt1 =  $pdo->prepare("SELECT name, user_id FROM users WHERE user_id = :id");
	$Stmt1->execute(array(':id' =>  $_GET['user_id']+0 ));
	$row = $Stmt1->fetch(PDO::FETCH_ASSOC);

	if( $row === false ){
		$_SESSION['error'] = "Bad user_id value";
		header("Location: index.php");
		return;
	}

	if( isset( $_POST['delete']) && isset($_POST['id'] ) ){
		$sql = "DELETE FROM users WHERE user_id = :id ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(':id' =>  $_POST['id']+0 ));
		$_SESSION['success'] = "Record Delelted!";
		header( "Location: index.php" );
		return;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
</head>
<body style="padding: 60px 30px;
  ">
	<h1>Delete Entry</h1>
	<p style="background-color: grey">Do you want to delete <?= htmlentities($row['name']) ?> ?</p>
	<br>
	<form method="POST">
		<input type="hidden" name="id" 
		value = <?=htmlentities($row['user_id'])?> >
		<input type="submit" name="delete" value="Delete">
		<a href="index.php">Escape</a>
	</form>
</body>
</html>