<?php

class AccountHandler{
	private function __construct(){}

	public static function getAccountByName($user){
		$q = "select * from accounts where username = :user";
		$result = DatabaseHandler->querySingleRowResult($q,new array(':user' => $user));
		
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
		DatabaseHandler->queryNoResult($q,new array(':user' => $mUser,':pass' => $mPass,':salt' => $mSalt, ':email' => $mEmail));
	}

	public static function attemptLogin($user,$pass){
		$mUser = $user;
		$mPass = $pass;
		
		Account $acct = this->getAccountByName($mUser);
		if(!$acct->isValid()){
			return FALSE;
		}
		if($acct->getPassword == this->hashFromPassword($mPass,$acct->getPWsalt())){
			return TRUE;
		}
	}
}

?>
