<?
include_once "./SearchEngine.php";
include_once "./GameView.php";
use GamerGoals\SearchEngine;
use GamerGoals\GameView;

	$resultsSection = "";
	$sen = SearchEngine::getInstance();
	if(isset($_POST['search'])){
		$results = $sen::findGames($_POST['search']);
		foreach($results as $r){
			//$resultsSection .= $r->toCSVString()."<br/>";
			$resultsSection .= GameView::toSearchResultRow($r)."\n";
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Search | GamerGoals</title>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
</head>
<body>

<? include "./navbar.inc"; ?>
<div class="container">
	<div class="row">
		<div class="span10 offset1">
			<form class="form-search" method="post" action="search.php">
				<div class="input-append">
				<input type="text" class="span8" name="search" placeholder="Search for..." />
				<button type="submit" class="btn" name="submit">Search</button>
				</div>
			</form>
		</div>
	</div>
	<div class="row" name="search-results">
		<?=$resultsSection?>
	</div>
</div>

</body>
</html>
