<?
include_once './AccountHandler.php';
use GamerGoals\AccountHandler;

$errorMessage = "";

if(isset($_POST['user']) && isset($_POST['pass'])){
	$vUser = $_POST['user'];
	$vPass = $_POST['pass'];

	$accth = AccountHandler::getInstance();
	try{
		$vResult = $accth->validateLogin($vUser,$vPass);
		// $errorMessage = "Success! Should be logged in now...";
		setcookie("user",$vUser,time()+(60*60));
		header('Location: ./index.php');
	}catch(Exception $e){
		$errorMessage .= $e->getMessage();
	}

	if($errorMessage != ""){
		$errorMessage = '<div class="alert alert-error text-center">'.$errorMessage.'</div>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | GamerGoals</title>
	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
</head>
<body>
	<? include "./navbar.inc" ?>
	<div class="container">
		<div class="row text-center">
			<h1>Login</h1>
		</div>
		<div class="row">
			<div class="span6 offset3">
				<?=$errorMessage?>
			</div>
		</div>
		<div class="row">
			<div class="span6 offset3">
				<form method="post" action="login.php" class="form-horizontal">
				<div class="control-group">
					<label class="control-label" for="inputUsername">Username</label>
					<div class="controls">
					<input id="inputUsername" name="user" type="text" /><br/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
					<input id="inputPassword" name="pass" type="password" /><br/>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
					<button name="submit" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
