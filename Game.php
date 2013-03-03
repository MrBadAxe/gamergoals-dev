<?php
namespace GamerGoals;

class Game{

	private $mId;
	private $mName;
	private $mPlatform;
	private $mYear;
	private $mDeveloper;
	private $mPublisher;

	public function __construct($id, $n, $pl, $y, $dev, $pub){
		$this->mId = $id;
		$this->mName = $n;
		$this->mPlatform = $pl;
		$this->mYear = $y;
		$this->mDeveloper = $dev;
		$this->mPublisher = $pub;
	}

	public function getGameId(){
		return $this->mId;
	}

	public function getName(){
		return $this->mName;
	}

	public function getPlatform(){
		return $this->mPlatform;
	}

	public function getYear(){
		return $this->mYear;
	}

	public function getDeveloper(){
		return $this->mDeveloper;
	}

	public function getPublisher(){
		return $this->mPublisher;
	}

	public function toCSVString($sep = ':'){
		$z = $this->mId .$sep;
		$z .= $this->mName . $sep;
		$z .= $this->mPlatform . $sep;
		$z .= $this->mYear . $sep;
		$z .= $this->mDeveloper . $sep;
		$z .= $this->mPublisher;
		return $z;
	}
}

?>
