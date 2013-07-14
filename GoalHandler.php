<?php

namespace GamerGoals;

include_once "./DatabaseHandler.php";
#include_once "./BinaryGoal.php";
include_once "./NumericGoal.php";
include_once "./GoalList.php";
use GamerGoals\DatabaseHandler;
#use GamerGoals\BinaryGoal;
use GamerGoals\NumericGoal;
use GamerGoals\GoalList;

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
		$q = "select * from numericgoals where goalid = :id";
		$result = DatabaseHandler::querySingleRowResult($q,array(':id' => $id));
		if($result == NULL){	return NULL; 	}
		return self::goalFromResultRow($type,$result);
	}

	public static function goalListFromAccount($game,$acct){
		#$bq = "select * from binarygoals where game = :game and account = :acct";
		$nq = "select * from numericgoals where game = :game and account = :acct";
		
		#$bresults = DatabaseHandler::queryMultiRowResult($bq,array(':game' => $game,':acct' => $acct));
		$nresults = DatabaseHandler::queryMultiRowResult($nq,array(':game' => $game,':acct' => $acct));

		#if($result == NULL){	return NULL; 	}
		return self::gameFromResultRow($result);
	}

	public static function goalFromResultRow($t, array $a){
		return new NumericGoal($a['goalid'],$a['userid'],$a['gameid'],$a['description'],$a['parent'],$a['target'],$a['current']);
	}


	public static function ownsGame(Account $a, Game $g){
		$q = "select * from owned where userid = :userid and gameid = :gameid";
		$result = DatabaseHandler::querySingleRowResult($q,array(':userid'=>$a->getUserId(), ':gameid'=>$g->getGameId()));
		return !($result == NULL);
	} 
}

?>
