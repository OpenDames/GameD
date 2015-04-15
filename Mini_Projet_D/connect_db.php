<?php 
class DbConnection
{

private $db;
public function __construct()
{
	try
	{
		$this->db = new PDO('mysql:host=localhost;dbname=game;charset=utf8', 'root', 'miatex');
	}
	catch(Exception $e)
	{
		die('Error : '.$e->getMessage());
	}
}


public function startGame($pseudoWhitePlayer,$pseudoRedPlayer,$B)
{	$sB = serialize($B);
	$req = $this->db->prepare('INSERT INTO game(`Pseudo_White_Player`, `Pseudo_Red_Player`, `Game_Array`) VALUES (?, ?, ?)');
	$req->execute(array($pseudoWhitePlayer,$pseudoRedPlayer,$sB));

}

public function updateGame($pseudoWhitePlayer,$pseudoRedPlayer,$B)
{
	$sB = serialize($B);
	$req = $this->db->prepare('UPDATE `game` SET `Game_Array`= ? WHERE `Pseudo_White_Player` = ? AND `Pseudo_Red_Player` = ?');
	$req->execute(array($sB,$pseudoWhitePlayer,$pseudoRedPlayer));
}

public function getGameArray($pseudoWhitePlayer,$pseudoRedPlayer)
{
	$req = $this->db->prepare('SELECT `Game_Array` FROM `game` WHERE `Pseudo_White_Player` = ? AND `Pseudo_Red_Player` = ?');
	$req->execute(array($pseudoWhitePlayer,$pseudoRedPlayer));
	$result = $req->fetch();
	return unserialize($result['Game_Array']);
}

public function getPlayerInformations($pseudoPlayer)
{
	$req = $this->db->prepare('SELECT * FROM `user` WHERE `Pseudo` = ? ');
	$req->execute(array($pseudoPlayer));
	$result = $req->fetch();
	return $result;
}

public function getPlayersInformations()
{
	$req = $this->db->prepare('SELECT * FROM `user`');
	$req->execute(array());
	return $req;
}

public function checkIfUserExists($pseudo,$password)
{
	$req = $this->db->prepare('SELECT count(*) FROM `user` WHERE `Pseudo` = ? AND `Password` = ?');
	$req->execute(array($pseudo,$password));
	$number = $req->fetchColumn();

	if($number>0) return true;
	else return false;
}

public function updateUser($column,$value,$pseudo)
{
	$req = $this->db->prepare('UPDATE `user` SET `'.$column.'`= ? WHERE `Pseudo` = ?');
	$req->execute(array($value,$pseudo));
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