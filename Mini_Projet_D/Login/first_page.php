<?php 
session_start();
if(isset($_SESSION['pseudo'])) 
{	

	include '../connect_db.php';
	$db = new DbConnection();
	$db->updateUser('Connected',0,$_SESSION['pseudo']);
	unset($_SESSION['pseudo']);

}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login Page</title>
</head>

<body>

<form action="login.php" method="post">
<label for="pseudo"> Pseudo:</label> <input  type="text" id="pseudo" name="pseudo"> <br>
<label for="password"> Password: </label> <input type="password" id="password" name='password'> <br>
<input type="submit"  value="Submit">

</form>

</body>
</html>
