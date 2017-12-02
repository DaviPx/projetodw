<?php
require_once ("controller/userController.php");
class UserValidator {
// CHECA EMAILS VALIDOS E SE NAO HA CAMPOS VAZIOS
public function isEmailValid($email) {
	
	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		return false;
	return true;
}


public function isNameValid($name){
if(!empty($name))
		return true;
return false;	
}

public function isPassValid($pass){
	if(!empty($pass))
	 	return true;
	return false;
	
}

public function isnickNameValid($nickName){
if(!empty($nickName))
	 	return true;
	return false;
	

}


}