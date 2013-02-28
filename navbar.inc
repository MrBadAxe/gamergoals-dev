<?php
	if(isset($_COOKIE["user"])){
		$home = "./my.php";
	}else{
		$home = "./index.php";
	}
?>

<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="<?=$home?>">GamerGoals</a>
		<ul class="nav">
			<? if(isset($_COOKIE["user"])){ ?>
			<li><a href="#">Welcome, <?=$_COOKIE["user"]?></a></li>
			<li><a href="./my.php">My Games</a></li>
			<li><a href="./search.php">Search</a></li>
			<li><a href="./logout.php">Log Out</a></li>
			<? }else{ ?>
			<li><a href="./login.php">Log In</a>
			<li><a href="./register.php">Register</a>
			<? } ?>
		</ul>
	</div>
</div>
