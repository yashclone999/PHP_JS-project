<?php
	require_once 'connect.php';
	require_once "bootstrap.php";

	$select = $pdo->query("SELECT name, email, password, user_id FROM users");
	session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Display</title>
</head>
<body style="padding: 60px 30px;
  ">
	<h1> Welcome to Application </h1>
	<hr>

	<?php
		if( isset($_SESSION['error']) ){
			echo nl2br('<p style = "color:red">'.$_SESSION['error']."</p>\n");
			unset($_SESSION['error']);
		}

		if( isset($_SESSION['success']) ){
			echo nl2br('<p style = "color:green">'.$_SESSION['success']."</p>\n");
			unset($_SESSION['success']);
		}


		if( !isset($_SESSION['account']) ){
		echo nl2br( '<span style=" color:red">LOG IN FIRST :</span> &nbsp' );
			echo ('<a href="login.php">LOGIN</a>');
		}
		else{

		echo ('<h1 style="color:blue;"> Welcome '.htmlentities($_SESSION['account']).'</h1><hr>');
		echo nl2br('<table border = "2" margin = "2">'."\n");
		echo "<tr><th> &nbsp NAME  &nbsp </th><th>  &nbsp Email  &nbsp </th><th>  &nbsp Password    &nbsp</th><th>  &nbsp Tune   &nbsp </th></tr>";
		while( $row = $select->fetch(PDO::FETCH_ASSOC) ){
			echo "<tr><td>";
			echo htmlentities($row['name']);
			echo "</td><td>";

			echo htmlentities($row['email']);
			echo "</td><td>";

			echo htmlentities($row['password']);
			echo "</td><td>";

			echo( ' <a href = "edit.php?user_id='.$row['user_id'].'">Edit</a>  &nbsp' );
			echo( ' <a href = "delete.php?user_id='.$row['user_id'].'">DELETE</a>' );

			echo "</td></tr>\n";
		}

		echo "</table>\n";
		echo (
			'<br> <a href="add.php">Add new entry</a>'
		);

		echo '<hr><p>When you are done <a href="logout.php">LOG OUT</a></p> ';
	}
	?>



</body>
</html>