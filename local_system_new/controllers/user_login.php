<?php
	include('../config/database.php');
	include('../includes/session.php');
	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	} 
	$_SESSION['error'] = array();
	if(empty($user_name))
	{
		$_SESSION['error'][] = "Please provide your user name or email..";
	}
	if(empty($password))
	{
		$_SESSION['error'][] = "Please provide your password..";
	}
	if(count($_SESSION['error']) == 0)
	{
		$salt = "#asd!&%lkjhgd@@@";
		$hash_password = md5(md5($salt) + md5($password));	
		$result = get_row("select user_id, privilege, password from user_data where (user_name = ? or email_id = ?) and password = ? ", array($user_name, $user_name, $hash_password));
		if($result == 0)
		{
			$_SESSION['error'][] = "Invalid user name or password.";
			$_SESSION['data'] = $user_name;
			header('location: ../user_login.php');
		}
		else
		{
			$_SESSION['user_id'] = $result['user_id'];
			$_SESSION['privilege'] = $result['privilege'];
			if($_SESSION['privilege'] == 1)
			{
				header('location: ../user_profile.php');
			}
			else if($_SESSION['privilege'] == 2)
			{
				header('location: ../admin_panal.php');	
			}
		}
	}
	else
	{
		echo $_SERVER['REQUEST_URI'];
		header('location: ../user_login.php');
	}	
?>