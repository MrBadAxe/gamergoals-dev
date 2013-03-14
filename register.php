<?

include_once './AccountHandler.php';
use GamerGoals\AccountHandler;
$errorMessage = "";

if(isset($_POST['user']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email'])){
	$vUser = $_POST['user'];
	$vPass1 = $_POST['pass1'];
	$vPass2 = $_POST['pass2'];
	$vEmail = $_POST['email'];

	$accth = AccountHandler::getInstance();
	if($vUser == ""){
		$errorMessage = "You must enter a username.";
	}elseif($accth->accountFromName($vUser) != NULL){
		$errorMessage = "Username '".$vUser."' not available.";
	}elseif(strlen($vPass1) < 6){
		$errorMessage = "Your password must be at least 6 characters long.";
	}elseif($vPass1 != $vPass2){
		$errorMessage = "Your passwords must match.";
	}else{
		$errorMessage = "creating account...";
		try{
			$accth->createAccount($vUser,$vPass1,$vEmail);
			header("Location: ./redirect.php?mode=1");
		}catch(Exception $e){
			$errorMessage = "Error creating account.";
		}
		
	}

	if($errorMessage != ""){
		$errorMessage = '<div class="alert alert-error text-center">'.$errorMessage.'</div>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register | GamerGoals</title>
	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
</head>
<body>
	<? include "./navbar.inc"; ?>
	<div class="container">
		<div class="row text-center">
			<h1>Register</h1>
		</div>
		<div class="row">
			<div class="span6 offset3">
				<?=$errorMessage?>
			</div>
		</div>
		<div class="span6 offset3">
			<form method="post" action="register.php" class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="inputUsername">Username</label>
				<div class="controls">
				<input id="inputUsername" name="user" type="text" /><br/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputPassword">Password</label>
				<div class="controls">
				<input id="inputPassword" name="pass1" type="password" /><br/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputPassRepeat">Repeat Password</label>
				<div class="controls">
				<input id="inputPassRepeat" name="pass2" type="password" /><br/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Email</label>
				<div class="controls">
				<input id="inputEmail" name="email" type="text" /><br/>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
				<button name="submit" type="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
