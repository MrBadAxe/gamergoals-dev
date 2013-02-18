<?
	$mode = 0;

	$dispTitle = "";
	$dispH1 = "";
	$dispH2 = "";

	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}
	switch($mode){
		case 1:
			$dispTitle = "Account Created";
			$dispH1 = "Account Created!";
			$dispH2 = "A validation email has been sent.";
			break;
		case 2:
			$dispTitle = "Account Validated";
			$dispH1 = "Account Validated!";
			$dispH2 = "You may now log in.";
			break;
		case 0:
		default:
			$dispTitle = "Error";
			$dispH1 = "Error";
			$dispH2 = "Something went wrong. Going back to home page...";
			break;
		
	}
	header( 'refresh: 2; url=./index.php' );
?>

<!DOCTYPE html>
<html>
<head>
	<title><?=$dispTitle?> | GamerGoals</title>
</head>
<body>
	<h1><?=$dispH1?></h1>
	<h2><?=$dispH2?></h2>
	<h3>if you don't redirect automatically, click <a href="./index.php">here</a></h3>
</body>
</html>
