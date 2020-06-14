<?php
	require_once('bootstrap.php');
	
	session_start();

	if(isset($_POST['reset'])){
		session_destroy();
		$_SESSION['chats'] = Array();
		header('Location: index.php');
		return;
	}

	if(isset($_POST['chat'])){
		if( !isset($_SESSION['chats']) ){
			$_SESSION['chats'] = Array();
		}

		$_SESSION['chats'][] = Array( $_POST['chat'], date(DATE_RFC2822) );
		header('Location: index.php');
		return;
		
	}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Chat</title>
	<script type="text/javascript" src="jquery-3.5.1.min.js"></script>
</head>

<body style="padding: 10px 30px ;">
	<h1>Chat</h1>
	<hr>

	<form method="POST">
		<label for='msg'>Message: </label>
		<input type="text" id='msg' name="chat">
		<br><br>
		<input type="submit" name="reset" value="Reset">
		<input type="submit" value="Chat">
	</form>

	<hr>
	<div id='chats'>
		
	</div>
	<script type="text/javascript">


	$(document).ready(function() {
			$.ajaxSetup({ cache: false});
			fetch();
		});

		function fetch() {
			console.log('Requesting chat messages');

			$.getJSON('respond.php', function(data) {
				window.console && console.log('JSON received');
				$('#chats').empty();

				for( var i = 0; i< data.length ; i++){

					row = data[i];
					$('#chats').append('<hr><p>'+ row[0] + '<br>&nbsp;&nbsp;' + row[1] + '</p><hr>');
				}
				//set inside the getJSON so that if JSON is not returned, you dont make another call, and stop.
				setTimeout('fetch()', 4000);
			});
			
		}
	</script>

	

</body>
</html>