<?php
	include('../includes/session.php');
	include('../config/database.php');
	
	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	}
	$_SESSION['errors'] =  array();
	if (empty($user_id))
	{
		$_SESSION['errors'][] = "Please select user";	
	}
	if (empty($operation))
	{
		$_SESSION['errors'][] = "Please select operation to perform.";	
	}
	if (count($_SESSION['errors']) == 0)
	{
		$_SESSION['user'] = $user_id;
		$_SESSION['option'] = $operation;
	}
	else
	{
		$_SESSION['data'] = $_POST;	
	}
	header('location: ../display_info.php');
?>	