<?php
	include('includes/header.php');
	include('config/globals.php');
	$result = get_rows("SELECT college_id, branch, semester, student_id, subject_id, marks FROM marks");
	$record = array();

	foreach ($result as $row) 
	{
		$record[$row['college_id']][$row['branch']][$row['semester']][$row['student_id']][$row['subject_id']][] = $row['marks'];	
	}
	echo '<table border=1>';
	echo '<tr>';
	echo '<td>College</td>';
	echo '<td>Branch</td>';
	echo '<td>Semester</td>';
	echo '<td>Student name</td>';
	echo '<td>subject</td>';
	echo '<td>Marks</td>';
	echo '</tr>';
	foreach ($record as $college_id => $records)
	{
		echo '<tr>';
		echo '<td colspan=6>'. $clg_name["$college_id"] . '</td>';
		foreach ($records as $branchb => $data)
		{
			echo '<tr>';
			echo '<td></td>';
			echo '<td colspan=5>' . $branch["$branchb"] . '</td>';
			foreach ($data as $semester => $students)
			{
				echo '<tr>';
				echo '<td colspan=2></td>';
				echo '<td colspan=4>' . $semester . '</td>';
				foreach ($students as $student_id => $subjets)
				{
					echo '<tr>';
					echo '<td colspan=3></td>';
					echo '<td colspan=3>' .$student["$student_id"] . '</td>';					
					foreach ($subjets as $subject_id => $marks)
					{
						echo '<tr>';
						echo '<td colspan=4></td>';
						echo '<td>' . $subject["$subject_id"] . '</td>';
						echo '<td>' . implode('<br/>', $record[$college_id][$branchb][$semester][$student_id][$subject_id]) . '</td>';
						echo '</tr>';
					}
					echo '</tr>';
				}
				echo '</tr>';
			}
			echo '</tr>';
		}
		echo '</tr>';
	}
	echo '</table>';

	include('includes/footer.php');
?>