<?php
namespace GamerGoals;

include_once "./Account.php";
include_once "./Game.php";
use GamerGoals\Account;
use GamerGoals\Game;

class OwnedGame{

	private	$mAccount;
	private $mGame;
	private $mPaid;
	private $mStatus;
	private $mNotes;

	public function __construct(Account $acct, Game $g, $paid = 0, $st = 'B', $notes = ""){
		$this->mAccount = $acct;
		$this->mGame = $g;
		$this->mPaid = $paid;
		$this->mStatus = $st;
		$this->mNotes = $notes;
	}

	public function getAccount(){
		return $this->mGame;
	}

	public function getGame(){
		return $this->mGame;
	}

	public function isPaid(){
		return $this->mPaid;
	}

	public function getStatus(){
		return $this->mStatus;
	}

	public function getNotes(){
		return $this->mNotes;
	}

	public function toCSVString($sep = ':'){
		$z = $this->mAccount->getUsername() .$sep;
		$z .= $this->mGame->getName() . $sep;
		$z .= $this->mPaid . $sep;
		$z .= $this->mStatus . $sep;
		$z .= $this->mNotes;
		return $z;
	}

	public static function fromResultRow(array $a){
		$g = GameHandler::gameFromId($a['gameid']);
		$acct = AccountHandler::accountFromId($a['userid']);
		return new OwnedGame($acct,$g,$a['paid'],$a['status'],$a['notes']);
	}

}

?>
