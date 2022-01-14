<?php
	session_start();
	//unset($_SESSION['usersid']);
	//unset($_SESSION['usersname']);
	//unset($_SESSION['usersimage']);
	unset($_SESSION['login']);


	header("location:index.php");
?>
