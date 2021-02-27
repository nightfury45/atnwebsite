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
	<form name="input" action="" method="get">
		Product ID: <input type="number" name="id" value="" /><br />
		Product Name:  <input type="text" name="name" value="" /><br />
		Product Price:  <input type="number" name="price" value="" /><br />
		Product Amount: <input type="number" name="amount" value="" /><br />
		<input type="submit" name="insert" value="Insert" />
		<input type="submit" name="update" value="Update" />
		<input type="submit" name="delete" value="Delete" />
	</form>
	<?php 
		if(isset($_GET['insert'])){
			$sql = "insert into stock(productid, productname, productprice, productamount) values('$_GET[id]', '$_GET[name]', '$_GET[price]', '$_GET[amount]')";
			$result = pg_query($pg_heroku, $sql);
			if($result){
			echo "Record saved";
			}
		}  
	?>
	<?php 
		if(isset($_GET['delete'])){
			$sql = "delete from stock where productid=$_GET[id]";
			$result = pg_query($pg_heroku, $sql);
			if($result){
			echo "Row deleted";
			}
		}  
	?>
	<?php 
		if(isset($_GET['update'])){
		$sql = "update stock set productname ='$_GET[name]' , productprice ='$_GET[price]', productamount = '$_GET[amount]' where id = $_GET[id]";
		$result = pg_query($pg_heroku, $sql);
		if($result){
		  echo "Updated successfully.";
		}
	?>
	<a href="logout.php">Logout</a>
</div>  	
</body>
<html>