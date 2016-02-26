<?php
	include('../includes/session.php');
	include('../config/database.php');
	
	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	}
	
	$_SESSION['errors'] = array();
	if (empty($clg_name))
	{
		$_SESSION['errors'][] = "Please select collage";	
	}
	
	if (empty($branch))
	{
		$_SESSION['errors'][] = "Please select entry branch";	
	}
	
	if (empty($semester))
	{
		$_SESSION['errors'][] = "Please select exit semester";	
	}
	if (empty($name))
	{
		$_SESSION['errors'][] = "Please select exit student";	
	}
	if (empty($subject))
	{
		$_SESSION['errors'][] = "Please select exit subject";	
	}
	if (empty($marks))
	{
		$_SESSION['errors'][] = "Please enter marks";	
	}
	if (!is_numeric($marks))
	{
		$_SESSION['errors'][] = "invalid marks";
	}
	else if($marks <= 0 )
	{
		$_SESSION['errors'][] = "please enter valid marks";
	}
	
	if(count($_SESSION['errors']) == 0)
	{
		$result = execute_query("INSERT INTO marks (collage_id, branch, semester, student_id, subject_id, marks) VALUES (?, ?, ?, ?, ?, ?)", array($clg_name, $branch, $semester, $name, $subject, $marks));
		$_SESSION['message'] = 'Your entry has been inserted.';
	}
	else
	{
		$_SESSION['data'] = $_POST;	
	}
	
	header('location: ../marks.php');
?>	