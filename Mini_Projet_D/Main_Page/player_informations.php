
<?php 
session_start();


include ('../connect_db.php');
require_once '../Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./');
$twig = new Twig_Environment($loader, array(
    'cache' => false
));




$db = new DbConnection();
$pseudo = '';
$firstName = '';
$lastName = '';
$score = 0;
if(isset($_SESSION['pseudo']))
{

$pseudo = $_SESSION['pseudo'];
$db->updateUser('Connected',1,$pseudo);
$information = $db->getPlayerInformations($pseudo);
$firstName = $information['First_Name'];
$lastName = $information['Last_Name'];
$score = $information['Score'];
$connection = $information['Connected']; 
$players = array();

$informations = $db->getPlayersInformations();
while($result =$informations->fetch())
{
	if($result['Pseudo'] != $pseudo)
	{
		$players[] =   array(
							'FIRST_NAME' => $result['First_Name'],
							'LAST_NAME' => $result['Last_Name'],
							'PSEUDO' => $result['Pseudo'],
							'SCORE' => $result['Score'],
							'CONNECTION' => $result['Connected']
							);
	}
}



$template = $twig->loadTemplate('main_page.phtml');
$params =array(
	'FIRST_NAME' => $firstName,
	'LAST_NAME' => $lastName,
	'PSEUDO' => $pseudo,
	'SCORE' => $score,
	'CONNECTION' => $connection,
	'FRIENDS' => $players
					  
		 );
echo $template->render($params);


if(isset($_POST['data']))
{
	$data = json_decode($_POST['data']);
	$db->updateUser('Connected',$data[0],$pseudo);

}
}

else {
	header('Location: ../Login/first_page.php');
}
?>
<html>
<script>



    

	 
window.onunload = window.onbeforeunload = (function(){
var C = [0];
		var check = JSON.stringify(C);
		$.ajax	(	{
				        type: "POST",
				        url: "player_informations.php",
				        data: {data : check}, 
				        cache: false,
				
				        success: function(msg)	{
				        	
				        	}
				    				}
				    			);
})
		



		 </script>

<body>

</body>
</html>