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
		$mId = $id;
		$mName = $n;
		$mPlatform = $pl;
		$mYear = $y;
		$mDeveloper = $dev;
		$mPublisher = $pub;
	}

	public getGameId(){
		return $mId;
	}

	public getName(){
		return $mName;
	}

	public getPlatform(){
		return $mPlatform;
	}

	public getYear(){
		return $mYear;
	}

	public getDeveloper(){
		return $mDeveloper;
	}

	public getPublisher(){
		return $mPublisher;
	}

}

?>
