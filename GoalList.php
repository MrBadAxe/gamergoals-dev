<?php
namespace Gamergoals;

include_once './DatabaseHandler.php';
include_once './AccountHandler.php';
include_once './Account.php';
include_once './GameHandler.php';
include_once './Game.php';
include_once './NumericGoal.php';
use Gamergoals\DatabaseHandler;
use Gamergoals\AccountHandler;
use Gamergoals\Account;
use Gamergoals\GameHandler;
use Gamergoals\Game;
use Gamergoals\NumericGoal;

class GoalList{

	private $mAccount;
	private $mNumericList;

	public function __construct(Account $a){
		$this->mAccount = $a;
		$this->mNumericList = array();
		$this->populateNumeric();
	}

	public function getNumericGoalsList(){
		return $this->mNumericList;
	}

	private function populateNumeric(){
		$q = 'select * from numericgoals where userid = :userid';
		$results = DatabaseHandler::queryMultiRowResult($q,array(':userid' => $this->mAccount->getUserId()));

		foreach($results as $row){
			$rwGoalId = $row['goalid'];
			$rwUserId = $row['userid'];
			$rwGameId = $row['gameid'];
			$rwDesc = $row['description'];
			$rwParent = $row['parent'];
			$rwTarget = $row['target'];
			$rwCurrent = $row['current'];

			$rwAccount = AccountHandler::accountFromId($rwUserId);
			$rwGame = GameHandler::gameFromId($rwGameId);
			array_push($this->mNumericList, new NumericGoal($rwGoalId,$rwUserId,$rwGameId,$rwDesc,$rwParent,$rwTarget,$rwCurrent));
		}
	}

	public function getGoalsForGame(Game $game){
		$list = array();
		foreach($this->mNumericList as $ng){
			if($ng->getGameId() == $game->getGameId()){
				array_push($list,$ng);
			}
		}
		return $list;
	}
}

?>
