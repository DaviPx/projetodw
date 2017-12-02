<?php

require_once ("model/request.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");
require_once("model/comment.php");

class CommentController {

	private $allowedOperations = Array('info', 'register', 'update', 'delete');
	private $request;
	private $collection = 'comments';
	
	public function __construct($request) {
		$this->request = $request;
	}			  

	public function routeOperation() {
		$body = json_decode($this->request->getBody(),true);
		switch($this->request->getOperation()) {
			case 'register':
					return $this->create($body);
			case 'info':
					if($this->request->getMethod() == "GET"){
						return $this->search($this->request->getQueryString());
					}

			case 'update':
					if($this->request->getMethod() == "PUT")
						return $this->update($body, $this->request->getQueryString());
			case 'delete' :
					if($this->request->getMethod() == "PUT")
					   return $this->delete($body);

					return (new RequestException(400, "Algo deu errado"))->toJson();
		}
	}
	
	
	private function create($body) { 	
		try{ 	
		 	new Comment($body["title"], $body["description"], $body["userName"], $body["testLinked"]);
		 	
		 	$result = (new DBHandler())->insert($body, $this->collection);
		 	
		 	if($result->getInsertedCount() == 1){
		 		return "{'code':'200','message':'insercao completa'}";
		 	}
		 	else
		 		http_response_code(417);
		 		return "{'code':'417','message':'falha na inserção'}";
		 }catch(RequestException $ue) {
		 	 return $ue->toJson();
		 }	
	}

	private function search($queryString) {
		return (new DBHandler())->search($queryString,$this->collection);
	}
	
	private function update($body, $queryString) {
		try{
			new Comment($body["title"], $body["description"], $body["userName"], $body["testLinked"]);
			$result = (new DBHandler())->update($queryString, $body, $this->collection);
			
			if($result->getModifiedCount() == 1){
		 		return "{'code':'200','message':'operação completa'}";
		 	}
		 	
		}
		catch(RequestException $ue) {
			http_response_code(417);
			return $ue->toJson();
		}
	}
	
	 private function delete($id) {
        return $this->update($this->collection, ['_id' => $id], ['$set'=>['enabled' => false]]);
    }

}
