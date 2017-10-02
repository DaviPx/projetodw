<?php

require_once ("model/user.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");

class UserController {

	private $allowedOperations = Array('info', 'register','update');
	private $request;
	
	public function __construct($request) {
		$this->request = $request;
	}			  

	public function routeOperation() {
		$body = json_decode($this->request->getBody(),true);
		switch($this->request->getOperation()) {
			case 'register':
					return $this->create($body);
			case 'info':
					if($this->request->getMethod() == "GET")
						return $this->search($this->request->getQueryString());
			case 'update':
			        
			    
			default:		
					return (new RequestException(400, "Bad request"))->toJson();
		}
	}
	
	
	private function create($body) { 	
		try{ 	
		 	new User($body["name"], $body["email"], $body["pass"], $body["nick"]);
		 	return (new DBHandler())->insert($body, 'users');
		 }catch(RequestException $ue) {
		 	 return $ue->toJson();
		 }	
	}

	private function search($queryString) { // COM A QUERY STRING E O NOME DA COLECAO (USERS) 
		return (new DBHandler())->search($queryString,$users,[]);
	}

}
