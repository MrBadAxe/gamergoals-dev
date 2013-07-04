<?php
namespace GamerGoals;

include_once './OwnedGame.php';
use GamerGoals\OwnedGame;

class BinaryGoal{

	private $mGoalId;
	private $mOwnedGame;
	private $mDescription;
	private $mParent;
	private $mDone;

	public function __construct($id, OwnedGame $og, $desc, $p = NULL, $done = 0){
		$this->mGoalId = $id;
		$this->mOwnedGame = $og;
		$this->mDescription = $desc;
		$this->mParent = $p;
		$this->mDone = ($done ? TRUE : FALSE);
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

	public function isDone(){
		return $this->mDone;
	}

	public function setStatus($done){
		$this->mDone = ($done ? TRUE : FALSE);
	}

	public function toCSVString($sep = ':'){
		$z = $this->mGoalId .$sep;
		$z .= '('.$this->mOwnedGame->toCSVString().')' . $sep;
		$z .= $this->mDescription . $sep;
		$z .= $this->mParent . $sep;
		$z .= ($this->mDone ? 'TRUE' : 'FALSE');
		return $z;
	}
}

?>
