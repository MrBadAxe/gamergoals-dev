<?php

namespace GamerGoals;

include_once "./DatabaseHandler.php";
include_once "./Account.php";
use GamerGoals\DatabaseHandler;
use GamerGoals\Account;
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

	public static function accountFromName($user){
		$q = "select * from accounts where username = :user";
		$result = DatabaseHandler::querySingleRowResult($q,array(':user' => $user));
		if($result == NULL){	return NULL; 	}
		return new Account($result['userid'], $result['username'], $result['password'], $result['pwsalt'],
					$result['created'], $result['validated'], $result['email']);
	}

	public static function accountFromHash($hash){
		$q = "select * from accounts where password = :pass";
		$result = DatabaseHandler::querySingleRowResult($q,array(':pass' => $hash));
		if($result == NULL){	return NULL; 	}
		return new Account($result['userid'], $result['username'], $result['password'], $result['pwsalt'],
					$result['created'],$result['validated'], $result['email']);
	}

	private function hashFromPassword($pw,$salt){
		return hash('sha256',$salt.$pw);
	}

	private function saltFromString($str){
		$mStr = $str;
		$msl = strlen($mStr);
		$hl = floor($msl/2);

		$h1 = substr($mStr,0,$hl);
		$h2 = substr($mStr,-1*$hl);
		$salt = substr($h1,0,1).substr($h1,-1,1).substr($h2,0,1).substr($h2,-1,1);
		return $salt;
	}

	public static function createAccount($user,$pass,$email){
		$mUser = $user;
		$mPass = $pass;
		$mSalt = self::saltFromString($user);
		$mHash = self::hashFromPassword($mPass,$mSalt);
		$mEmail = $email;

		$q = "insert into accounts (username,password,pwsalt,email) values(:user,:pass,:salt,:email)";
		DatabaseHandler::queryNoResult($q,array(':user' => $mUser,':pass' => $mHash,':salt' => $mSalt, ':email' => $mEmail));
	}

	public static function validateLogin($user,$pass){
		$mUser = $user;
		$mPass = $pass;
		
		$acct = self::accountFromName($mUser);
		
		if($acct == NULL){
			throw new Exception("Username '".$mUser."' does not exist.");
		}
		if($acct->getPassword() != self::hashFromPassword($mPass,$acct->getPasswordSalt())){
			throw new Exception("password for '".$acct->getUsername()."' is incorrect.");
			//throw new Exception("password for ".$acct->getUsername()."is incorrect: ".$acct->getPassword()." != ".self::hashFromPassword($mPass,$acct->getPasswordSalt()));
		}
		if(!$acct->isValid()){
			throw new Exception("The account for username '".$mUser."' has not been validated.");
		}
		return TRUE;
	}

	public static function validateAccount($key){
		$mKey = $key;
		$acct = self::accountFromHash($mKey);
		if($acct == NULL){	
			throw new Exception("Username '".$mUser."' does not exist.");
		}
		if($acct->getPassword() == $mKey){
			DatabaseHandler::queryNoResult("update accounts set validated='1' where username = :user",array(':user'=>$acct->getUsername()));
		}
		return TRUE;
	}
}

?>
