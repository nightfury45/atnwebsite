<?php
session_start();
$role1 = "branchmanager";
$role2 = "director";

$userinfo = array(
                $role1=>'123',
                $role2=>'123'
                );
if(isset($_GET['logout'])) {
    $_SESSION['username'] = '';
    header('Location:  ' . $_SERVER['PHP_SELF']);
}

if(isset($_POST['username'])) {
    if($userinfo[$_POST['username']] == $_POST['password']) {
        $_SESSION['username'] = $_POST['username'];
    }else {
        //Invalid Login
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Login</title>
    </head>
    <body>
        <?php
			$username = $_SESSION['username'];
			if($username == $role1)
				header("location:branchmanager.php");
			if($username == $role2)
				header("location:director.php");
        ?>
        <form name="login" action="" method="post">
            Username:  <input type="text" name="username" value="" /><br />
            Password:  <input type="password" name="password" value="" /><br />
            <input type="submit" name="submit" value="Submit" />
        </form>

    </body>
</html>