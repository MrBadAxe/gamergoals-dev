<?php
namespace GamerGoals;

include_once './OwnedGame.php';
use GamerGoals\OwnedGame;

class NumericGoal{

	private $mGoalId;
	private $mOwnedGame;
	private $mDescription;
	private $mParent;
	private $mTarget;
	private $mCurrent;

	public function __construct($id, OwnedGame $og, $desc, $p = NULL, $tgt, $cur = 0){
		$this->mGoalId = $id;
		$this->mOwnedGame = $og;
		$this->mDescription = $desc;
		$this->mParent = $p;
		$this->mTarget = $tgt;
		$this->mCurrent = $cur;
	}

	public function getGoalId(){
		return $this->mGoalId;
	}

	public function getOwnedGame(){
		return $this->mOwnedGame;
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
		$z .= '('.$this->mOwnedGame->toCSVString().')' . $sep;
		$z .= $this->mDescription . $sep;
		$z .= $this->mParent . $sep;
		$z .= $this->mTarget . $sep;
		$z .= $this->mCurrent . $sep;
		return $z;
	}
}

?>
