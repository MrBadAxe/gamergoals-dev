<?

include_once "./Game.php";
include_once "./GameView.php";
include_once "./GameHandler.php";
include_once "./AccountHandler.php";
use Gamergoals\Game;
use Gamergoals\GameView;
use Gamergoals\GameHandler;
use Gamergoals\AccountHandler;


	if(!$_GET['id']){
		$title = "Game Not Found";
	}else{
		$g = GameHandler::gameFromId($_GET['id']);
		if($g == NULL){
			$title = "Game Not Found";
		}else{
			$title = $g->getName();
		}
	}	
?>

<!DOCTYPE html>
<html>
<head>
<title>GamerGoals</title>
<script src="./owned.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
</head>
<body>

<? include "./navbar.inc"; ?>
<div class="container">
	<div class="row text-center">
		<h2><?=$title?></h2>
		<div class="">
		<? if($g == NULL){ ?>
			<a class="btn btn-large btn-primary" href="./search.php">Search for another Game</a>
		<? }else{ ?>
			<div class="row">
				<div class="span6 offset3">for <i><?=GameView::formatPlatform($g->getPlatform())?></i> (<?=$g->getYear()?>)</div>
			</div>	
			<div class="row">
				<div class="span6 offset3">
				Developed by <?=$g->getDeveloper()?>&nbsp;&mdash;&nbsp;
				Published by <?=$g->getPublisher()?></div>
			</div>
			</br>
			<div>
			<? if(!$_COOKIE['user']){ ?>
				<a class="btn btn-large btn-standard" href="./login.php">Login to Add to Your Collection</a>
			<? }else{
				$a = AccountHandler::accountFromName($_COOKIE['user']);
				if(!GameHandler::ownsGame($a, $g)){ ?>
					<div class="span4 offset4"><?=GameView::generateStatusButton($g, $a)?></div>
				<? }else{ ?>
				Add Goal code here
				<? } ?>
			<? } ?>
			</div>
		<? } ?>
		</div>
	</div>
</div>

</body>
</html>
