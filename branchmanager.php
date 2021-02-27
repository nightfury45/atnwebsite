<html>
<head>
<p> Branch Manager <P>
</head>
<body>
	<?php 
		echo '<p>Stock Create, Read, Edit and Delete mode</p>'; 
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
  <h3>CRUD Example Using PHP OOPS And PostgreSQL</h3>
  <a href="insert.php" class="btn btn-primary pull-right" style='margin-top:-30px'><span class="glyphicon glyphicon-plus-sign"></span> Add Record</a>
  <br>
  
  <div class="panel panel-primary">
        <div class="panel-heading">CRUD Example Using PHP OOPS And PostgreSQL</div>
             
            <div class="panel-body">
            <table class="table table-bordered table-striped">
    <thead>
      <tr class="active">
            <th>Sr. No.</th>  
            <th >ID</th>       
            <th>Name</th>
            <th>Price</th>
            <th>Amount</th>
            <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php while($user = pg_fetch_object($users)): ?>   
      <tr align="left">
        <td ><?=$sn++?></td>
        <td><?=$user->productid?></td>
        <td><?=$user->productname?></td>
        <td><?=$user->productprice?></td>
        <td><?=$user->productamount?></td>
        <td>
            <form method="post">
                <input type="submit" class="btn btn-success" name= "update" value="Update">   
                <input type="submit" onClick="return confirm('Please confirm deletion');" class="btn btn-danger" name= "delete" value="Delete">
                <input type="hidden" value="<?=$user->id?>" name="id">
            </form>
        </td>
      </tr>
    <?php endwhile; ?>   
    </tbody>
  </table>
</div>
 
</div>
</div>  	
</body>
<html>