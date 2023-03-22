<?php

	ini_set("session.save_path", "/home/unn_w21006726/sessionData");
	session_start();
	
	$_SESSION = array();
	
	session_destroy();
	header("Location: http://unn-w21006726.newnumyspace.co.uk/NMCLoginForm.html"); //redirect user to login page
?>

