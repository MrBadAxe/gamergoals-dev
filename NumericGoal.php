<?php
namespace GamerGoals;

include_once './OwnedGame.php';
use GamerGoals\OwnedGame;

class NumericGoal{

	private $mGoalId;
	private $mUserId;
	private $mGameId;
	private $mDescription;
	private $mParent;
	private $mTarget;
	private $mCurrent;

	public function __construct($goalid, $userid, $gameid, $desc, $p = NULL, $tgt, $cur = 0){
		$this->mGoalId = $goalid;
		$this->mUserId = $userid;
		$this->mGameId = $gameid;
		$this->mDescription = $desc;
		$this->mParent = $p;
		$this->mTarget = $tgt;
		$this->mCurrent = $cur;
	}

	public function getGoalId(){
		return $this->mGoalId;
	}
	public function getUserId(){
		return $this->mUserId;
	}
	public function getGameId(){
		return $this->mGameId;
	}

	public function getDescription(){
		return $this->mDescription;
	}

	public function setDescription($desc){
		$this->mDescription = $desc;
	}

	public function getParent(){
		return $this->mParent;
	}

	public function getTarget(){
		return $this->mTarget;
	}

	public function getCurrent(){
		return $this->Current;
	}

	public function setCurrent($newcur){
		$this->mCurrent = $newcur;
	}

	public function toCSVString($sep = ':'){
		$z = $this->mGoalId .$sep;
		$z = $this->mUserId .$sep;
		$z = $this->mGameId .$sep;
		$z .= $this->mDescription . $sep;
		$z .= $this->mParent . $sep;
		$z .= $this->mTarget . $sep;
		$z .= $this->mCurrent . $sep;
		return $z;
	}
}

?>
