<?php
include "configImport.php";
	header("Content-type: application/vnd-ms-excel");
	$filename = "Student List.xlsx";
	header("Content-Disposition: attachment;filename=\"$filename\"");
?>

<table class = "table table=bordered">
	<thread>
		<tr>
			<th style = "border:2px solid black; background-color: #bfbfbf; width: 150px">
				First Name:
			</th>
			<th style = "border:2px solid black; background-color: #bfbfbf; width: 150px">
				Last Name:
			</th>
			<th style = "border:2px solid black; background-color: #bfbfbf; width: 150px">
				Nickname:
			</th>
			<th style = "border:2px solid black; background-color: #bfbfbf; width: 150px">
				Birthday:
			</th>
			<th style = "border:2px solid black; background-color: #bfbfbf; width: 750px">
				Notes:
			</th>
		</tr>
	</thread>

		<?php
			$user_qry =
				"SELECT
				*
				FROM studentInfo";
			$user_res = mysqli_query($con, $user_qry) or die("Database connection error. Please try again later!");

			while($user_data = mysqli_fetch_assoc($user_res)) 
			{
		?>
				<tr>
					<td style = "border:2px solid black;">
						<?php echo $user_data['student_first_name']; ?>
					</td>

					<td style = "border:2px solid black;">
						<?php echo $user_data['student_last_name']; ?>
					</td>

					<td style = "border:2px solid black;">
						<?php echo $user_data['nickname']; ?>
					</td>

					<td style = "border:2px solid black;">
						<?php echo $user_data['birthday']; ?>
					</td>

					<td style = "border:2px solid black;">
						<?php echo $user_data['notes']; ?>
					</td>
				</tr>
	<?php	} ?>
</table>