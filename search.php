<?php
	if(isset($_GET['searchterms']){
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
			<form class="form-search" onsubmit="">
				<div class="input-append">
				<input type="text" class="span8" name="search" placeholder="Search for..." />
				<button type="submit" class="btn" name="submit">Search</button>
				</div>
			</form>
		</div>
	</div>
	<div class="row" name="search-results">
	</div>
</div>

</body>
</html>
