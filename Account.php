<?php
namespace GamerGoals;

class Account{
	private $mId;
	private $mUsername;
	private $mPassword;
	private $mPWsalt;
	private $mCreated;
	private $mValidated;
	private $mEmail;

	public function __construct($id, $un, $pw, $salt, $cr, $v, $em){
		$this->mId = $id;
		$this->mUsername = $un;
		$this->mPassword = $pw;
		$this->mPWsalt = $salt;
		$this->mCreated = $cr;
		$this->mValidated = $v;
		$this->mEmail = $em;
	}

	public function getUserId(){
		return $this->mId;
	}

	public function getUsername(){
		return $this->mUsername;
	}

	public function getPassword(){
		return $this->mPassword;
	}

	public function getPasswordSalt(){
		return $this->mPWsalt;
	}
	
	public function getCreated(){
		return $this->mCreated;
	}

	public function isValid(){
		return $this->mValidated;
	}

	public function getEmail(){
		return $this->mEmail;
	}

}

?>
