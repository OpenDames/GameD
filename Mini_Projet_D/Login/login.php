<?php 
session_start();
include '../connect_db.php';


$db = new DbConnection();
$exists = $db->checkIfUserExists($_POST['pseudo'],$_POST['password']);
if($exists)
{	
	$_SESSION['pseudo'] = $_POST['pseudo'];
	header('Location: ../Main_Page/player_informations.php');
}
else header('Location: first_page.php');



?>