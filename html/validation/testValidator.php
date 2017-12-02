<?php

class TestValidator {
// CHECA SE NAO HA CAMPOS VAZIOS

public function isTitleValid($title){
	if(!empty($title))
		return true;
return false;	
}

public function isDirectoryValid($directory){
	if(!empty($directory))
	 	return true;
return false;
	

}

public function isUserNameValid($nick){ //CRIAR FUNCAO PARA NICK REPETIDO E EMAIL TBM
	if(!empty($nick))
	 	return true;
return false;
	
}


}
