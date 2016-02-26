<?php
	include('includes/session.php');
	
	if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0)
	{
		$error_message = '<strong>' . implode(', ', $_SESSION['errors']) . '</strong>';
		unset($_SESSION['errors']);	
	}
	$post_data = array();
	if (isset($_SESSION['data']))
	{
		$post_data = $_SESSION['data'];
		unset($_SESSION['data']);	
	}
	if(isset($_SESSION['user']))
	{
		$user = $_SESSION['user'];
		unset($_SESSION['user']);
	}
	if (isset($_SESSION['option']))
	{
		$operation = $_SESSION['option'];
		unset($_SESSION['option']);	
	}
	include('includes/header.php');
	if (isset($error_message))
	{
		echo '<strong>' . $error_message . '<strong>';
	}

		$users = get_rows("select id, name from users order by name");
?>
		<form method="post" action="controllers/user_validate.php" >
		user:
		<?php
			if (count($users) > 0)
			{
		?>
		<select name="user_id" id="user_id" onclick="">
		<?php
			echo '<option value="">Select a user</option>';
			foreach ($users as $row)
			{
				echo '<option ' . ((isset($post_data['user_id']) && $post_data['user_id'] == $row['id']) ? 'selected="selected"': '') . ' value="' . $row['id'] . '">' . $row['name'] . '</option>';
			}	
		?>
		</select>
		<?php
			}
			else
			{
				echo 'Please enter data for users';	
			}
		?>
		<br>
		operation:
		<select name="operation" id="operation" >
		<option value=""> select operation </option>
		<option value="1"> All entry </option>
		<option value="2"> latest and oldest entry </option>
		<option value="3"> generate report </option>
		<option value="4"> find maximum working hours </option>
		</select>
		<input type="submit" id="submit" name="submit">

		</form>

<?php
		
			switch ($operation)
			{
				case '1':
						$all_data = get_rows("SELECT entry_datetime, exit_datetime FROM attendance WHERE user_id =" . $user);
						echo '<table border=1>';
						echo '<tr><td>entry datetime</td><td>exit datetime</td></tr>';
						foreach ($all_data as $row)
						{
							echo '<tr><td> ' . $row['entry_datetime'] . '</td><td>' . $row['exit_datetime'] . '</tr>';
						}	
						echo '</table>';
						break;

				case '2':
						$user_result2 = get_row("SELECT max(entry_datetime) from attendance where user_id=" . $user);
						$user_result3 = get_row("SELECT min(entry_datetime) from attendance where user_id=" . $user);
						echo '<table border=1>';
						echo '<tr><td></td><td>entry datetime</td></tr>';
						echo '<tr><td> latest entry is:</td>';
						echo '<td>' . $user_result2[0] . '</td></tr>';
						echo '<tr><td> oldest entry is:</td>';
						echo '<td>' . $user_result3[0] . '</td></tr>';
						echo '</table>';
						break;

				case '3':
						$result = get_rows("SELECT entry_datetime, exit_datetime, month(entry_datetime) as month, year(entry_datetime) as year from attendance where user_id=" .$user);
						$user_record = array();
						
						foreach ($result as $row) 
						{
							$user_record[$row['year']][$row['month']][] = $row['entry_datetime'] . "&nbsp&nbsp" . $row['exit_datetime'];	
						}
						echo '<table border=1>';
						foreach ($user_record as $year => $record)
						{
							echo '<tr>';
							echo '<td>'. $year . '</td>';
							echo '</tr>';
							foreach ($record as $month => $row)
							{
								echo '<tr>';
								echo '<td>' . date("F", mktime(0, 0, 0, $month, 10)) . '</td>';
								echo '<td>' . implode('<br/>', $user_record[$year][$month]) . '</td>';
								echo '</tr>';
							}
						}
						echo '</table>';
						break;

				case '4':
						$user_result5 = get_row("SELECT entry_datetime, exit_datetime, timediff(exit_datetime,entry_datetime) as difference  from `attendance` where user_id=" . $user . " order by difference DESC limit 1" );
						echo '<table border=1>';
						echo '<tr><td>entry datetime</td><td>exit datetime</td><td>working hours</td></tr>';
						echo '<tr><td> ' . $user_result5['entry_datetime'] . '</td><td>' . $user_result5['exit_datetime'] . '</td><td>' . $user_result5['difference'] . '</td></tr>';

						echo '</table>';
						break;

				default:
					# code...
					break;
			}
		
	include('includes/footer.php');
?>