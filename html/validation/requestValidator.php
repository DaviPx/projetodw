<?php

include_once "IrequestValidator.php";

class RequestValidator implements IRequestValidator 
{
	private $allowedMethods = Array('GET', 'PUT', 'POST');

	private $allowedUris = 
			Array('users' => Array('info', 'register','update','delete', 'login'),
				  'tests' => Array('info','register','update','delete','login'),
				  'comments' => Array('info','register','update','delete'));

	public function isUriValid($uri) {
		$arrayUri = explode('/', $uri);
		
		if(!in_array($arrayUri[1], array_keys($this->allowedUris)))
			return false;
		
		if(!in_array($arrayUri[2], $this->allowedUris[$arrayUri[1]]))
			return false;
		
		return true;		
	}

	public function isMethodValid($method) {

		if(!in_array($method, $this->allowedMethods)) 
			return false;

		return true;		
	}

	public function isProtocolValid($protocol) {
		
	}

	

	public function isQueryStringValid($qs) {
		
	}

	public function isBodyValid($body) {
		
	}
}