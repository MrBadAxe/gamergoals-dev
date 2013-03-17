<?php

include_once './DatabaseHandler.php';
use GamerGoals\DatabaseHandler;

$mUserId = $_GET['userid'];
$mGameId = $_GET['gameid'];

//echo $mUserId.':'.$mGameId."\n";
$params = array(':userid'=>$mUserId,':gameid'=>$mGameId);
//print_r($params);

$query = 'insert into owned (userid,gameid,paid,status,notes) values (:userid,:gameid,"1","B","") ';
//echo $query;

try{
	DatabaseHandler::queryNoResult($query,$params);
}catch(Exception $e){
	echo 'error: '.$e->getMessage();
}

echo 'success';

?>
