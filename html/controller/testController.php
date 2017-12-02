<?php

require_once ("model/test.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");

class TestController {

	private $allowedOperations = Array('info', 'register', 'update', 'delete');
	private $request;
	private $collection = 'tests'; // A COLECAO QUE ESTA LA NO DBDaviRocha
	
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
					if($this->request->getMethod() == "PUT")
						return $this->update($body, $this->request->getQueryString());
			case 'delete' :
				if($this->request->getMethod() == "PUT")
						return $this->update($body, $this->request->getQueryString());
			//default:		
					return (new RequestException(400, "Tipo de request nao reconhecida"))->toJson();
		}
	}
	
	
	private function create($body) { 	
		try{ 	
		 	new  Test($body["title"], $body["directory"],$body["userName"]);
		 	$result = (new DBHandler())->insert($body, $this->collection); // ANTES ESTAVA ESCRITO TESTS EM VEZ DE $COLLECTION
		 	if($result->getInsertedCount() == 1){
		 	return "{'code':'200','message':'inserção completa'}";
		 	}
		 	else
		 		return (new RequestException(417, "Falha na insercao"))->toJson();
		 }catch(RequestException $re) {
		 	 return $re->toJson();
		 }	
	}

	private function search($queryString) {
		return (new DBHandler())->search($queryString,$this->collection);
	}
	
	private function update($body, $queryString) {
		try{
			new Test($body["title"], $body["directory"],$body["userName"]);
			$result = (new DBHandler())->update($queryString, $body, $this->collection);
			if($result->getModifiedCount() == 1){
		 		return "{'code':'200','message':'modificacao completada com sucesso'}";
		 	}
		 	else
		 		return (new RequestException(417, "Nao foi possivel modificar"))->toJson();
		}catch(RequestException $ue) {
			http_response_code(401);
			return $ue->toJson();
		}
	}
	
	private function delete($queryString) {
		if($queryString != null)
			return (new DBHandler())->delete($queryString, $this->collection);
		return (new RequestException(400, "Por favor especifique o que deseja deletar"))->toJson(); 
	}

}
