<?php
	include('../includes/session.php');
	include('../config/database.php');
	
	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	}
	
	$_SESSION['errors'] = array();
	if (empty($user_id))
	{
		$_SESSION['errors'][] = "Please select user";	
	}
	
	if (empty($entry_datetime))
	{
		$_SESSION['errors'][] = "Please select entry time";	
	}
	
	if (empty($exit_datetime))
	{
		$_SESSION['errors'][] = "Please select exit time";	
	}
	
	if (count($_SESSION['errors']) == 0)
	{
		$result = execute_query("insert into attendance(user_id, entry_datetime, exit_datetime) values(?, ?, ?)", array($user_id, $entry_datetime, $exit_datetime));
		$_SESSION['message'] = 'Your entry has been inserted.';
	}
	else
	{
		$_SESSION['data'] = $_POST;	
	}
	
	header('location: ../user.php');
?>	