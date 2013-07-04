<?php

namespace GamerGoals;

include_once "./DatabaseHandler.php";
include_once "./BinaryGoal.php";
include_once "./NumericGoal.php";
use GamerGoals\DatabaseHandler;
use GamerGoals\BinaryGoal;
use GamerGoals\NumericGoal;

class GoalHandler{
	private function __construct(){}
	private static $glh;

	public static function getInstance(){
		if(self::$glh == NULL){
			self::$glh = new GoalHandler();
		}
		return self::$glh;
	}

	public static function goalFromId($type,$id){
		if($type != 'B' && $type != 'N'){
			return NULL;
		}
		$table = (($type == 'B') ? "binarygoals" : "numericgoals");
		$q = "select * from ".$table." where goalid = :id";
		$result = DatabaseHandler::querySingleRowResult($q,array(':id' => $id));
		if($result == NULL){	return NULL; 	}
		return self::goalFromResultRow($type,$result);
	}

	public static function goalListFromAccount($game,$acct){
		$bq = "select * from binarygoals where game = :game and account = :acct";
		$nq = "select * from numericgoals where game = :game and account = :acct";
		
		$bresults = DatabaseHandler::queryMultiRowResult($bq,array(':game' => $game,':acct' => $acct));
		$nresults = DatabaseHandler::queryMultiRowResult($nq,array(':game' => $game,':acct' => $acct));

		#if($result == NULL){	return NULL; 	}
		return self::gameFromResultRow($result);
	}

	public static function goalFromResultRow($t, array $a){
		return (($t == 'B') 	? new BinaryGoal($a['goalid'],$a['name'],$a['platform'],$a['year'],$a['developer'],$a['publisher'])
					: new NumericGoal($a['goalid']));
	}


	public static function ownsGame(Account $a, Game $g){
		$q = "select * from owned where userid = :userid and gameid = :gameid";
		$result = DatabaseHandler::querySingleRowResult($q,array(':userid'=>$a->getUserId(), ':gameid'=>$g->getGameId()));
		return !($result == NULL);
	} 
}

?>
