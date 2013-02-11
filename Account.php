<?php

class Account{
	private $mId;
	private $mUsername;
	private $mPassword;
	private $mCreated;
	private $mValidated;
	private $mEmail;

	public __construct($id,$un,$pw,$cr,$v,$em){
		$mId = $id;
		$mUsername = $un;
		$mPassword = $pw;
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
