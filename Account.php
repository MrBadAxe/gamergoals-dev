<?php

class Account{
	private $mId;
	private $mUsername;
	private $mPassword;
	private $mPWsalt;
	private $mCreated;
	private $mValidated;
	private $mEmail;

	public __construct($id,$un,$pw,$salt,$cr,$v,$em){
		$mId = $id;
		$mUsername = $un;
		$mPassword = $pw;
		$mPWsalt = $salt;
		$mCreated = $cr;
		$mValidated = $v;
		$mEmail = $em;
	}

	private getUserId(){
		return $mId;
	}

	private getUsername(){
		return $mUsername;
	}

	private getPassword(){
		return $mPassword;
	}

	private getPasswordSalt(){
		return $mPWsalt;
	}
	
	private getCreated(){
		return $mCreated;
	}

	private isValidated(){
		return $mValidated;
	}

	private getEmail(){
		return $mEmail;
	}

}

?>
