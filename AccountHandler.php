<?php

namespace GamerGoals;

include_once '../ggpath.rc';
include_once "$ggpath/classes/DatabaseHandler.php";
use GamerGoals\DatabaseHandler;
use Exception;

class AccountHandler{
	private function __construct(){}
	private static $accth;

	public static function getInstance(){
		if(self::$accth == NULL){
			self::$accth = new AccountHandler();
		}
		return self::$accth;
	}

	public static function getAccountByName($user){
		$q = "select * from accounts where username = :user";
		$result = DatabaseHandler::querySingleRowResult($q,array(':user' => $user));
		if($result == NULL){
			throw new Exception("No Results");
		}
		
		$rId = $result['userid'];
		$rUser = $result['username'];
		$rPass = $result['password'];
		$rPWsalt = $result['pwsalt'];
		$rCreated = $result['created'];
		$rValid = $result['validated'];
		$rEmail = $result['email'];

		return new Account($rId,$rUser,$rPass,$rPWsalt,$rCreated,$rValid,$rEmail);
	}

	private function hashFromPassword($pw,$salt){
		return hash('sha256',$salt.$pw);
	}

	private function saltFromString($str){
		$mStr = $str;
		$hl = strlen($mStr)/2;
		$h1 = substr($mStr,$hl);
		$h2 = substr($mStr,$hl*-1);
		$salt = substr($h1,1).substr($h1,-1).substr($h2,1).substr($h2,-1);
		return $salt;
	}

	public static function createAccount($user,$pass,$email){
		$mUser = $user;
		$mPass = $pass;
		$mSalt = saltFromString($user);
		$mEmail = $email;

		$q = "insert into accounts (username,password,pwsalt,email) values(:user,:pass,:salt,:email)";
		DatabaseHandler::queryNoResult($q,array(':user' => $mUser,':pass' => $mPass,':salt' => $mSalt, ':email' => $mEmail));
	}

	public static function validateLogin($user,$pass){
		$mUser = $user;
		$mPass = $pass;
		
		$acct = self::getAccountByName($mUser);
		
		if($acct == FALSE){
			throw new Exception("Username '".$mUser."' does not exist.");
		}
		if(!$acct::isValid()){
			throw new Exception("The account for username '".$mUser."' has not been validated.");
		}
		if($acct::getPassword() != self::hashFromPassword($mPass,$acct::getPasswordSalt())){
			throw new Exception("Your password is incorrect.");
		}
		return TRUE;
	}
}

?>
