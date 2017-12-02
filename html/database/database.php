<?php

class DBHandler {

	const DB_NAME = "dbDaviRocha";

	public function getConnection() {
		try {

		    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

		    return $mng;

		} catch (MongoDB\Driver\Exception\Exception $e) {
		    
		    return json_encode(
		    			 	Array(
		    			 		"msg"  => $e->getMessage(), 
		    			 		"file" => $e->getFile(), 
		    			 		"line" => $e->getLine()
		    			 	));       
		}
	}

	public function insert($document, $collection) {
		$conn = $this->getConnection();
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->insert($document);
		$result = $conn->executeBulkWrite("dbDaviRocha.".$collection, $bulk); // NOME DA DATABASE: DaviRocha
		return $result;
	}

	public function search($parameters, $collection) {
		$conn = $this->getConnection();
		$options['projection'] = ['password'=> 0]; // PARA NAO FICAR MOSTRANDO A TODOS O PASSWORD DO USUARIO
		$query = new MongoDB\Driver\Query($parameters, $options);
		$rows = $conn->executeQuery("dbDaviRocha.".$collection, $query);
		$result = Array();
		foreach ($rows as $row) {
    
        array_push($result, $row);
    }
		return json_encode($result);
	}
	
	
	public function update($querystring, $set, $collection) {
		$conn = $this->getConnection();
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->update($querystring, $set);
		$result = $conn->executeBulkWrite("dbDaviRocha.".$collection, $bulk);
										
		return $result;
	}
	public function delete($collection, $id){
        return $this->update($collection, ['_id' => $id], ['$set'=>['enabled' => false]]);
    }
	}