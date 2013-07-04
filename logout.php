<?
	setcookie("user",$_COOKIE["user"],time()-100);
	header('Location: '.$_SERVER['HTTP_REFERER']);
?>
