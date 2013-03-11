<?php
namespace GamerGoals;

include_once './DatabaseHandler.php';
include_once './AccountHandler.php';
include_once './GameHandler.php';
include_once './OwnedGame.php';

use GamerGoals\DatabaseHandler;
use GamerGoals\AccountHandler;
use GamerGoals\OwnedGame;
use GamerGoals\GameHandler;

class Collection{
	private $mUserId;
	private $mOwnedGames;

	public function __construct(Account $a = NULL){
		$this->mOwnedGames = array();
		if($a == NULL){
			//echo "account is null\n";
			$this->mUserId = 0;
		}else{
			//echo 'account id is '.$a->getUserId()."\n";
			$this->mUserId = $a->getUserId();
			//echo "now calling populate\n";
			$this->populate();
		}
	}

	public function getUserId(){
		return $this->mUserId;
	}

	public function getOwnedGameList(){
		return $this->mOwnedGames;
	}

	private function populate(){
		//echo "called populate\n";
		if($this->mUserId == NULL || $this->mUserId == 0){
			//echo "mUserId is zero or null\n";
			return;
		}
		$q = 'select * from owned where userid = :userid';
		$results = DatabaseHandler::queryMultiRowResult($q,array(':userid' => $this->mUserId));
		foreach($results as $row){
			$rwUserId = $row['userid'];
			$rwGameId = $row['gameid'];
			$rwPaid = $row['paid'];
			$rwStatus = $row['status'];
			$rwNotes = $row['notes'];

			$rwAccount = AccountHandler::accountFromId($rwUserId);
			$rwGame = GameHandler::gameFromId($rwGameId);
			//print_r($this->mOwnedGames);
			array_push($this->mOwnedGames, new OwnedGame($rwAccount,$rwGame,$rwPaid,$rwStatus,$rwNotes));
		}
		//print_r($this->mOwnedGames);
	}

	public function hasGame(Game $g){
		foreach($this->mOwnedGames as $mOwned){
			if($g->getGameID() == $mOwned->getGame()->getGameId()){
				return TRUE;
			}
		}
		return FALSE;
	}
}

?>
