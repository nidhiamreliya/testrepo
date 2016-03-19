<?php
	include('../includes/session.php');
	include('../config/database.php');
	include('check_authentication.php');
	$result = execute_query("DELETE FROM user_data where user_id= ?", array($_GET['id']));
	$_SESSION['message'] = "Record has been removed."; 
	
	header('location: ../admin_panal.php');
?>