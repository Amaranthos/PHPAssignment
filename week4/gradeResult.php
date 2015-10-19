<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../custom.css">
	</head>
	<body>
		<h1 class="yellow">Your results are as follows:</h1>
		<table>
		<?php
			$gpa = 0;
		?>
			<tr>
				<td>Class</td>
				<td>Grade</td>
				<td>Result</td>			
			</tr>
			<?php
				for($i = 0; $i < 4; $i++){
					$subject = (isset($_POST['subject'.$i]))? $_POST['subject'.$i] : null;
					$result = (isset($_POST['result'.$i]))? (int)$_POST['result'.$i] : null;
					$gpa += $result;

					if($subject && $result){
						?>
						<tr>
							<td><?=$subject?></td>
							<td><?php
									if($result < 50){
										?><span class='red'>Fail</span><?php
									}
									elseif($result < 65){
										?><span class='green'>Pass</span><?php
									}

									elseif($result < 75){
										?><span class='green'>Credit</span><?php
									}

									elseif($result < 85){
										?><span class='green'>Distinction</span><?php
									}

									elseif($result >= 85){
										?><span class='green'>High Distinction</span><?php
									}
								?></td>
								<td><?=$result?></td>
						</tr>
						<?php
					}
				}
				$gpa/=4;
			?>
			<tr>
				<td>GPA</td>
				<td><?php
					if($gpa < 50){
						?><span class='red'>Fail</span><?php
					}
					elseif($gpa < 65){
						?><span class='green'>Pass</span><?php
					}

					elseif($gpa < 75){
						?><span class='green'>Credit</span><?php
					}

					elseif($gpa < 85){
						?><span class='green'>Distinction</span><?php
					}

					elseif($gpa >= 85){
						?><span class='green'>High Distinction</span><?php
					}
				?></td>
				<td><?=$gpa?></td>
			</tr>
		</table>
	</body>
</html>