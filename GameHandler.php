<?php

namespace GamerGoals;

include_once "./DatabaseHandler.php";
include_once "./Game.php";
use GamerGoals\DatabaseHandler;
use GamerGoals\Game;

class GameHandler{
	private function __construct(){}
	private static $gh;

	public static function getInstance(){
		if(self::$gh == NULL){
			self::$gh = new GameHandler();
		}
		return self::$gh;
	}

	public static function gameFromId($id){
		$q = "select * from games where gameid = :id";
		$result = DatabaseHandler::querySingleRowResult($q,array(':id' => $id));
		if($result == NULL){	return NULL; 	}
		return self::gameFromResultRow($result);
	}

	public static function gameFromName($name){
		$q = "select * from games where name = :name";
		$result = DatabaseHandler::querySingleRowResult($q,array(':name' => $name));
		if($result == NULL){	return NULL; 	}
		return self::gameFromResultRow($result);
	}

	public static function gameFromResultRow(array $a){
		return new Game($a['gameid'],$a['name'],$a['platform'],$a['year'],$a['developer'],$a['publisher']);
	}

	public static function ownsGame(Account $a, Game $g){
		$q = "select * from owned where userid = :userid and gameid = :gameid";
		$result = DatabaseHandler::querySingleRowResult($q,array(':userid'=>$a->getUserId(), ':gameid'=>$game->getGameId()));
		return !($result == NULL);
	} 
}

?>
