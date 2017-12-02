<?php
require_once("exception/requestException.php");
class UserController {


	private $allowedOperations = Array('info', 'register','update','delete','login');
	private $request;
	private $collection = 'users';
	
	public function __construct($request) {
		$this->request = $request;
		
	}			  

	public function routeOperation() {

		$body = json_decode($this->request->getBody(),true);
		
		switch($this->request->getOperation()) {

			case 'register':
			if($this->request->getMethod() == "POST")
				return $this->create($body);
			return (new RequestException(400, "Algo deu errado"))->toJson();
			case 'info':
					if($this->request->getMethod() == "GET")
						
						return $this->search($this->request->getQueryString());
					return (new RequestException(400, "Algo deu errado"))->toJson();
			
			case 'update':
					if($this->request->getMethod() == "PUT")
						return $this->update($body, $this->request->getQueryString());
			
			case 'delete':
					if($this->request->getMethod() == "PUT")
					return $this->delete();

			case 'login':
				if($this->request->getMethod() == "POST")
					$storedUser = json_decode($this->search($body));
				if(($storedUser[0]->nickName == $body["nickName"])&&($storedUser[0]->pass == $body["pass"])){
						return "'code':'200', 'message':'Login Efetuado com Sucesso'";
					}
					
					return (new RequestException(401, "Nao autorizado"))->toJson();
				}
			
					return (new RequestException(400, "Bad request"))->toJson();
		}
	
	
	
	private function create($body) { 	
		try{
			new User($body["name"], $body["password"],$this->checkUniqueEmail($body),$this->checkUniqueNickName(($body)));
		 	
		 	$result = (new DBHandler())->insert($body, $this->collection);
		 	
		 	if($result->getInsertedCount() == 1){
		 		return "{'code':'200','message':'inserção completa'}";
		 	}
		 	else
		 	
		 		return (new RequestException(417, "Falha na inserção"))->toJson();
		 }catch(RequestException $ue) {
		 	 return $ue->toJson();
		 }	
	}

	private function search($queryString) {
		return (new DBHandler())->search($queryString, $this->collection);
	}
	
	private function update($body, $queryString) {
		try{
		 	new User($body["name"], $body["password"], $body["email"], $body["nickName"]);
			$result = (new DBHandler())->update($queryString, $body, $this->collection);
			if($result->getModifiedCount() == 1){
		 		return "{'code':'200','message':'operação completa'}";
		 	}
		 	else
		 		http_response_code(417);
		 		return "{'code':'417','message':'falha na operação'}";
		}catch(RequestException $ue) {
			http_response_code(417);
			return $ue->toJson();
		}
	}

	 private function delete() {
        $body = $this->request->getBody();
        var_dump($body);
        $collection = $this->request->getResource();
        var_dump($collection);
        $id = $body['_id'];
        $result = (new DBHandler())->delete($collection, $id);
        if ($result->getModifiedCount() == 0)
            throw new RequestException('404', 'Objeto nao encontrado');

        
        return json_encode(Array('code' => '200', 'message' => 'Ok'));
    }

private function checkUniqueNickName($body){
$storedUser = json_decode($this->search($body));
$nickName = $body["nickName"];
				if($storedUser[0]->nickName == $nickName){
						return "{'code':'417','message':'nickName ja esta em uso'}";
					}
					else
						return $nickName;
}
private function checkUniqueEmail($body){
$storedUser = json_decode($this->search($body));
$email = $body["email"];
				if($storedUser[0]->email == $email){
						return "{'code':'417','message':'email ja esta em uso'}";
					}
					
				else		
			return $email;

}

} //FECHA PHP