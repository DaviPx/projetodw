<?php

require_once("validation/userValidator.php");
require_once ("exception/requestException.php");

class User {
	
	private $name;
	private $email;
	private $password;
    private $uv;
	private $nick;

	public function __construct($name, $email, $pass,$nick) {
	 	$this->uv = new UserValidator();
	 	$this->name = $name;
		$this->setEmail($email);
		$this->password = $pass;
		$this->nick = $nick;		
	}

	
    public function getName()
    {
        return $this->name;
    }

   
    public function setName($name)
    {
        $this->name = $name;
    }

    
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

   
    public function getNick()
    {
        return $this->nick;
    }

   
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email) {
		if(!$this->uv->isValidEmail($email)){
			throw new RequestException(400, "Invalid email format");
		}	
		$this->email = $email;
	}
}
