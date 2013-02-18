<?
include_once './AccountHandler.php';
use Gamergoals\AccountHandler;

if(!isset($_GET['key'])){
	header("Location: ./redirect.php");
}

$key = $_GET['key'];
$accth = AccountHandler::getInstance();

try{
	if($accth::validateAccount($key)){
		$mode = 2;
	}
}catch(Exception $e){
	$mode = 0;
}

header("Location: ./redirect.php?mode=".$mode);

?>
