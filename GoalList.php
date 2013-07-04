<?php
include_once './DatabaseHandler.php';
include_once './Account.php';
include_once './Game.php';
use Gamergoals\DatabaseHandler;
use Gamergoals\Account;
use Gamergoals\Game;

public class GoalList{

	private $mAccount;

	private $mBinaryList;
	private $mNumericList;

	public function __construct(Account $a){
		$this->mAccount = $a;
		populateBinary();
		populateNumeric();
	}

	public function getBinaryGoalsList(){
		return $mBinaryList;
	}
	public function getNumericGoalsList(){
		return $mNumericList;
	}

	private function populateBinary(){
		$q = 'select * from binarygoals where userid = :userid';
		$results = DatabaseHandler::queryMultiRowResult($q,array(':userid' => $this->mAccount->getUserId()));

		foreach($results as $row){
			$rwGoalId = $row['goalid'];
			$rwUserId = $row['userid'];
			$rwGameId = $row['gameid'];
			$rwDesc = $row['description'];
			$rwParent = $row['parent'];
			$rwDone = $row['done'];

			$rwAccount = AccountHandler::accountFromId($rwUserId);
			$rwGame = GameHandler::gameFromId($rwGameId);
			array_push($this->mBinaryList, new BinaryGoal($rwGoalId,$rwAccount,$rwGame,$rwDesc,$rwParent,$rwDone));
		}
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
			array_push($this->mNumericList, new NumericGoal($rwGoalId,$rwAccount,$rwGame,$rwDesc,$rwParent,$rwTarget,$rwCurrent));
		}
	}
}

?>
