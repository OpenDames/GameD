<?php 
class DbConnection
{


public function __construct()
{
	try
	{
		$this = new PDO('mysql:host=localhost;dbname=game;charset=utf8', 'root', 'miatex');
	}
	catch(Exception $e)
	{
		die('Error : '.$e->getMessage());
	}
}


public function startGame($idWhitePlayer,$idRedPlayer,$B)
{	$sB = serialize($B);
	$req = $this->prepare('INSERT INTO game(`ID_White_Player`, `ID_Red_Player`, `Game_Array`) VALUES (?, ?, ?)');
	$req->execute(array($idWhitePlayer,$idRedPlayer,$sB));

}

public function updateGame($idWhitePlayer,$idRedPlayer,$B)
{
	$sB = serialize($B);
	$req = $this->prepare('UPDATE `game` SET `Game_Array`= ? WHERE `ID_White_Player` = ? AND `ID_Red_Player` = ?');
	$req->execute(array($sB,$idWhitePlayer,$idRedPlayer));
}

public function getGameArray($idWhitePlayer,$idRedPlayer)
{
	$req = $this->prepare('SELECT `Game_Array` FROM `game` WHERE `ID_White_Player` = ? AND `ID_Red_Player` = ?');
	$req->execute(array($idWhitePlayer,$idRedPlayer));
	$result = $req->fetch();
	return unserialize($result['Game_Array']);
}

public function getPlayerInformations($idPlayer)
{
	$req = $this->prepare('SELECT * FROM `user` WHERE `ID_Player` = ? ');
	$req->execute(array($idPlayer));
	$result = $req->fetch();
	return $result;
}

public function checkUser($pseudo,$password)
{
	$req = $this->prepare('SELECT count(*) FROM `user` WHERE `Pseudo` = ? AND `Password` = ?');
	$req->execute(array($pseudo,$password));
	$number = $req->fetchColumn();

	if($number>0) return true;
	else return false;

}

}


 $B = array(
				 array(0,-1,0,-1,0,-1,0,-1)
				,array(-1,0,-1,0,-1,0,-1,0)
				,array(0,-1,0,-1,0,-1,0,-1)
				,array(0,0,0,0,0,0,0,0)
				,array(0,0,0,0,0,0,0,0)
				,array(1,0,1,0,1,0,1,0)
				,array(0,1,0,1,0,1,0,1)
				,array(1,0,1,0,1,0,1,0)
				,array(null,null,null,null)
			)








 ?>