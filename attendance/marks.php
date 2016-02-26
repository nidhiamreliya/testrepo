<?php
	include('includes/session.php');

	if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0)
	{
		$error_message = '<font color="red">' . implode('<br/> ', $_SESSION['errors']) . '</font>';
		unset($_SESSION['errors']);	
	}
	if (isset($_SESSION['message']))
	{
		$message = $_SESSION['message'];
		unset($_SESSION['message']);
	}
	if (isset($_SESSION['data']))
	{
		$user_data = $_SESSION['data'];
		unset($_SESSION['data']);
	}

	include('includes/header.php');

	if (isset($error_message))
	{
		echo $error_message;	
	}
	if (isset($message))
	{
		echo '<strong>' . $message . '</strong>';
	}
	include('config/globals.php');
?>
	<form method="post" action="controllers/form_validate.php">
		College name:
			<select name="clg_name" id="clg_name">
				<option value="">select college</option>
				<?php
				foreach($clg_name as $id=>$name)
				{
						echo '<option ' . ((isset($user_data['clg_name']) && $user_data['clg_name'] == $id) ? 'selected="selected"': '') . ' value="' . $id . '">' . $name . '</option>';
				}
				?>
			</select>
		<br/><br/>
		Branch:
			<select name="branch" id="branch">
			<option value="">select branch</option>
				<?php
				foreach($branch as $id=>$branch)
				{
						echo '<option ' . ((isset($user_data['branch']) && $user_data['branch'] == $id) ? 'selected="selected"': '') . ' value="' . $id . '">' . $branch . '</option>';
				}
				?>	
			</select>
		<br/><br/>
		Semester:
			<select name="semester" id="semester">
			<option value="">select semester</option>
				<?php
				foreach($semester as $sem)
				{
					echo '<option ' . ((isset($user_data['semester']) && $user_data['semester'] == $sem) ? 'selected="selected"': '') . ' value="' . $sem . '">' . $sem . '</option>';
				}
				?>	
			</select>
		<br/><br/>
		Student name:
			<select name="name" id="name">
			<option value="">select student</option>
				<?php
				foreach($student as $id=>$name)
				{
					echo '<option ' . ((isset($user_data['name']) && $user_data['name'] == $id) ? 'selected="selected"': '') . ' value="' . $id . '">' . $name . '</option>';
				}
				?>
			</select>
		<br/><br/>
		Subject:
			<select name="subject" id="subject">
			<option value="">select subject</option>
				<?php
				foreach($subject as $id=>$subject)
				{
					echo '<option ' . ((isset($user_data['subject']) && $user_data['subject'] == $id) ? 'selected="selected"': '') . ' value="' . $id . '">' . $subject . '</option>';
				}
				?>	
			</select>
		<br/><br/>
		Marks:
			<input type="text" name="marks" id="marks"/>
		<br/><br/>
			<input type="submit" name="submit" />
	</form>
	<input type="button" value="report" id="report" onClick="document.location.href='marks_report.php'" />
<?php
	include('includes/footer.php');
?>