<?

include_once './AccountHandler.php';
include_once './Collection.php';
include_once './GameView.php';
use GamerGoals\AccountHandler;
use GamerGoals\Collection;
use GamerGoals\GameView;

$user = "";
if(isset($_COOKIE['user'])){
	$user = $_COOKIE['user'];
	$c = new Collection(AccountHandler::accountFromName($user));
}else{
	header('Location: ./login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Your Games | GamerGoals</title>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
</head>
<body>

<? include "./navbar.inc"; ?>

<div class="text-center">
	<h1><?=$user?>'s Games</h1>
</div>
<div class="container">
	<div class="row">
	<?
		foreach($c->getOwnedGameList() as $og){
			//print_r($og->getGame());
			echo GameView::toSearchResultRow($og->getGame(),$c);
		}
	?>	
	</div>
</div>

</body>
</html>
