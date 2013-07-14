<?

include_once "./Game.php";
include_once "./GameView.php";
include_once "./GameHandler.php";
include_once "./GoalHandler.php";
include_once "./AccountHandler.php";
use Gamergoals\Game;
use Gamergoals\GameView;
use Gamergoals\GameHandler;
use Gamergoals\GoalHandler;
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
					<div class="span4 offset4">
						<a class="btn btn-large" href="./addgoal.php">Add New Goal</a>
					</div>
					
					<div class="span10 offset1">
					<?
						$list = new GoalList($a);

						$nlist = $list->getGoalsForGame($g);
						foreach($nlist as $ng){
							/* 
							show description
							show button to modify description
							if binary, put button to change status
							if numeric, put fields to increment/decrement number
							*/
							?>
							<div class="well well-small">
								<?=$ng->toCSVString()?>
							</div>
							<?
						}
					?>
					</div>
					<div class="span4 offset4">
						<a class="btn btn-large" href="./addgoal.php">Add New Goal</a>
					</div>
				<? } ?>
			<? } ?>
			</div>
		<? } ?>
		</div>
	</div>
</div>

</body>
</html>
