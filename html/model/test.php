<?php
require_once("validation/testValidator.php");
class Test {

    private $name;
    private $directory;
    private $userName;
    private $createdDate;
    private $tv;

    public function __construct($title,$directory,$userName) {
        $this->tv = new TestValidator();
        $this->title= $this-> setTitle($title);
        $this->directory= $this-> setDirectory($directory);
        $this->userName=$this-> setUserName($userName);
        $this->createdDate = $this->setCreatedDate();
        

    }

    public function getCreatedDate() {
        return $this->createdDate;
    }



    public function getName() {
        return $this->name;
    }

    public function setTitle($title){
 if (!$this->tv->isTitleValid($title))
            throw new RequestException("400", "o titulo nao pode ficar em branco!!");

        $this->title = $title;


}
    public function getDirectory() {
        return $this->directory;
    }
public function setDirectory($directory){
 if (!$this->tv->isDirectoryValid($directory))
            throw new RequestException("400", "o diretorio nao pode ficar em branco!!");

        $this->directory = $directory;


}
    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($userName){
 if (!$this->tv->isUserNameValid($userName))
            throw new RequestException("400", "o autor nao pode ficar em branco!!");

        $this->userName = $userName;


}

   public function setCreatedDate(){
   	$date = new DateTime();
   	return $date->getTimestamp();
   }

}
