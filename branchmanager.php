<html>
<head>
<p> Branch Manager <P>
</head>
<body>
	<?php 
		# Heroku credential 
		$host_heroku = "ec2-52-70-67-123.compute-1.amazonaws.com";
		$db_heroku = "d18ccjsmc2b6fp";
		$user_heroku = "tohgxktdsqguyu";
		$pw_heroku = "7432a249a31fd290580d1ffeffbbbc8856f74377bc9cbdee3abb24529e2e43de";
		# Create connection to Heroku Postgres
		$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
		$pg_heroku = pg_connect($conn_string);
		
		if (!$pg_heroku)
		{
			die('Error: Could not connect: ' . pg_last_error());
		}
	?>
<div class="container-fluid bg-3 text-center">    
  <h3>Stock Create, Read, Edit and Delete mode</h3>
  <a href="insert.php" class="btn btn-primary pull-right" style='margin-top:-30px'><span class="glyphicon glyphicon-plus-sign"></span> Add Record</a>
  <br>
	<?php
  		# Get data by query
		$query = 'select * from Stock';
		$result = pg_query($pg_heroku, $query);
		# Display data column by column
		$i = 0;
		echo '<html><body><table><tr>';
		while ($i < pg_num_fields($result))
		{
			$fieldName = pg_field_name($result, $i);
			echo '<td>' . $fieldName . '</td>';
			$i = $i + 1;
		}
		echo '</tr>';
		# Display data row by row
		$i = 0;
		while ($row = pg_fetch_row($result)) 
		{
			echo '<tr>';
			$count = count($row);
			$y = 0;
			while ($y < $count)
			{
				$c_row = current($row);
				echo '<td>' . $c_row . '</td>';
				next($row);
				$y = $y + 1;
			}
			echo '</tr>';
			$i = $i + 1;
		}
		pg_free_result($result);
		echo '</table></body></html>';
	?>
</div>  	
</body>
<html>