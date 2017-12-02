<?php

class CommentValidator {


public function isValidTitle($title){
	if(!empty($title)){
	 	return true;
	 return false;
	}
}

public function isValidDescription($description){
	if(!empty($description)){
	 	return true;
	 return false;
	}
}

public function isValidNickname($nickName){ // PROCURAR SE O NICKNAME EXISTE NO DATABASE
	if(!empty($nickName)){
	 	return true;
	 return false;
	}
}

public function isValidTestLinked($testLinked){ // PROCURAR SE O NICKNAME EXISTE NO DATABASE
	if(!empty($testLinked)){
	 	return true;
	 return false;
	}
}



}