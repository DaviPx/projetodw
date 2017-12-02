<?php
require_once ('validation/userValidator.php');
require_once ('exception/requestException.php');

class User {
	private $uv;
    private $name;
    private $password;
    private $email;
    private $nickName;

    public function __construct($name,$password,$email,$nickName) { // VERIFICAR SE NICKNAME JA EXISTE?
        $this->uv = new UserValidator();
        $this->name = $this->setName($name);
        $this->password = $this->setPassword($password);
		    $this->email = $this->setEmail($email);
        $this->nickName = $this->setNick($nickName);
    }

 
   public function getName(){
   	return $this->name;
   }
   

public function setName($name){
 if (!$this->uv->isNameValid($name))
            throw new RequestException("400", "o nome nao pode ficar em branco!!");

        $this->name = $name;


}

public function getEmail(){
   	return $this->name;
   }


public function setEmail($email){ 
 if (!$this->uv->isEmailValid($email))
            throw new RequestException("400", "email nao e valido ou e repetido!");

$this->email = $email;

}


    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        if (!$this->uv->isPassValid($password))
            throw new RequestException("400", "a senha nao pode ficar em branco!!!");

        $this->password = $password;



    }

  public function getNick(){
   	return $this->nickName;
   }
   

public function setNick($nickName){
 if (!$this->uv->isnickNameValid($nickName))
            throw new RequestException("400", "o nickname nao pode ficar em branco!!");

        $this->nickName = $nickName;


}



}
