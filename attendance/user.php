<?php
	include('includes/session.php');
	if (isset($_SESSION['message']))
	{		
		$message = '<strong>' . $_SESSION['message'] . '</strong>';
		unset($_SESSION['message']);
	}
	
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
		
	include('includes/header.php');
	
	if (isset($message))
	{
		echo $message;
	}
	if (isset($error_message))
	{
		echo $error_message;	
	}
	$users = get_rows("select id, name from users order by name");
?>
		
		<script src="js/user.js">
		</script>
		
		<form method="post" action="controllers/attendance.php" onsubmit="return check_user_form()">
				User: 
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
				<br/> <br/>	
				Entry time <input type="text"  id="entry_datetime" name="entry_datetime" value="<?=isset($post_data['entry_datetime']) ? $post_data['entry_datetime']: ''?>" />				
				<br/><br/>
				Exit time <input type="text"  id="exit_datetime" name="exit_datetime" value="<?=isset($post_data['exit_datetime']) ? $post_data['exit_datetime']: ''?>"	/>
				 <br/>

				<input type="submit" name="submit" value="Save"  />	
		</form>	
		<script type="text/javascript">
		$(function(){
			$('*[name=entry_datetime]').appendDtpicker();
		});
		$(function(){
			$('*[name=exit_datetime]').appendDtpicker();
		});
		
		</script>
<?php
					
		include('includes/footer.php');
?>
