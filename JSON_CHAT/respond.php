<?php 
	session_start();


	header('Content-Type: application/json; charset=utf-8;');

	if( ! isset($_SESSION['chats']) ){
		$_SESSION['chats'] = Array();
	}
	echo( json_encode($_SESSION['chats']) );



?>