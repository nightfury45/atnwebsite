<?php 
	# Heroku credential 
	$host_heroku = "ec2-18-206-84-251.compute-1.amazonaws.com";
	$db_heroku = "d8k42dnhtd0o9i";
	$user_heroku = "crmjpgdtqgprga";
	$pw_heroku = "0d86d0fb5f24be75ffb6728bb2ffaa6762b75489e8923fda3cdf71c519a99d67";
	# Create connection to Heroku Postgres
	$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
	$pg_heroku = pg_connect($conn_string);
	
	if (!$pg_heroku)
	{
		die('Error: Could not connect: ' . pg_last_error());
	}
	if ( !isset($_POST['username'], $_POST['password']) ) 
	{
		// Could not get the data that should have been sent.
		exit('Please fill both the username and password fields!');
	}
		// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
		// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
		$stmt->bind_param('s', $_POST['username']);
		$stmt->execute();
		// Store the result so we can check if the account exists in the database.
		$stmt->store_result();
		if ($stmt->num_rows > 0) 
		{
				$stmt->bind_result($id, $password);
				$stmt->fetch();
				// Account exists, now we verify the password.
				// Note: remember to use password_hash in your registration file to store the hashed passwords.
				if (password_verify($_POST['password'], $password)) 
				{
					// Verification success! User has logged-in!
					// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
					session_regenerate_id();
					$_SESSION['loggedin'] = TRUE;
					$_SESSION['name'] = $_POST['username'];
					$_SESSION['id'] = $id;
					header('Location: home.php');
				} 
				else 
				{
					// Incorrect password
					echo 'Incorrect username and/or password!';
				}
		} 
		else 
		{
			// Incorrect username
			echo 'Incorrect username and/or password!';
		}
		$stmt->close();
	}	
?>
