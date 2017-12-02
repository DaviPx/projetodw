<?php
require_once("validation/commentValidator.php");
class Comment {

    private $title;
    private $description;
    private $cv;
    private $userName; // PEGA O NOME DO USUARIO QUE CRIOU

    public function __construct($title, $description,$userName,$testLinked) {
        $this->cv = new CommentValidator();
		$this->title =$this-> setTitle($title);
		$this->description = $this-> setDescription($description);
        $this->userName = $this-> setUserName($userName);
        $this->testLinked = $this-> setTestLinked($testLinked); // VERIFICAR SE EXISTE ESSA PROVA
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
       if (!$this->cv->isValidTitle($title))
            throw new RequestException("400", "o titulo nao pode ficar em branco!!");
$this->title = $title;
}


 public function getDescription() {
        return $this->description;
    }
public function setDescription($description){
 if (!$this->cv->isValidDescription($description))
            throw new RequestException("400", "a descricao nao pode ficar em branco!!");
$this->description = $description;


}
    
// ---------------------------------------------    
public function getUserName(){
	return $this->userName;
}

public function setUserName($userName){
     if (!$this->cv->isValidNickname($userName))
            throw new RequestException("400", "o username nao pode ficar em branco!!");
$this->username = $username;

}


 public function getTestLinked() {
        return $this->description;
    }
public function setTestLinked($testLinked){
 if (!$this->cv->isValidTestLinked($testLinked))
            throw new RequestException("400", "o comentario precisa de ter uma prova setada!!");
$this->description = $description;


}



}
