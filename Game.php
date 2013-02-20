<?php
namespace GamerGoals;

class Game{

	private $mId;
	private $mName;
	private $mPlatform;
	private $mYear;
	private $mDeveloper;
	private $mPublisher;

	public __construct($id,$n,$pl,$y,$dev,$pub){
		$this->mId = $id;
		$this->mName = $n;
		$this->mPlatform = $pl;
		$this->mYear = $y;
		$this->mDeveloper = $dev;
		$this->mPublisher = $pub;
	}

	public getGameId(){
		return $this->mId;
	}

	public getName(){
		return $this->mName;
	}

	public getPlatform(){
		return $this->mPlatform;
	}

	public getYear(){
		return $this->mYear;
	}

	public getDeveloper(){
		return $this->mDeveloper;
	}

	public getPublisher(){
		return $this->mPublisher;
	}

}

?>
