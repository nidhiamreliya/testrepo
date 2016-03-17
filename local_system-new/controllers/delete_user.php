<?php
	include('../includes/session.php');
	include('../config/database.php');

	if(isset($_GET['id']) && $_GET['id'] != "" && isset($_SESSION['user_id']) && $_SESSION['privilege'] == 2)
	{
		$result = execute_query("DELETE FROM user_data where user_id= ?", array($_GET['id']));
		$_SESSION['message'] = "Record has been removed."; 
	}
	header('location: ../admin_panal.php');
?>