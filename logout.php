<?
	setcookie("user",$_COOKIE["user"],time()-100);
	header('Location: ./index.php');
?>
