<?php

require_once("validation/testValidator.php");
require_once ("exception/requestException.php");


class Test {
    
    private $title;
    private $archiveLocation;
    private $userName;
    private $timestamp;
    private $tv;
    private $comments;
    
    public function __construct($title,$archiveLocation,$userName) {
        $this->tv=new testValidator();
        $this->title= $title;
        $this->archiveLocation = $archiveLocation;
        $this->userName = $userName;
        $this->timestamp = $this->setTimestamp();
        $this->comments = null; // QUANDO EU CRIO UM TEST ELE AINDA NAO TEM COMENTARIOS
    }
    
    public function getId(){ // ID E UNICO, N PODE SER SETADO DPS
        return $this->id;
    }
    
   
    
  
    public function getArchiveLocation()
    {
        return $this->archiveLocation;
    }

   
    public function getComments()
    {
        return $this->comments;
    }

   
    public function setArchiveLocation($archiveLocation)
    {
        $this->archiveLocation = $archiveLocation;
    }

    
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getTitle(){
        return $this->title;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function getUserName(){ // SO GET ESTA OK, USAR SETUSER PARA O QUE?
        return $this->userName;
    }
    
  
    
    public function getText(){
        return $this->text;
    }
    
    public function setText($text){
        $this->text = $text;
    }
    
    private function setTimestamp(){
        $date = new DateTime();
       return  $date->getTimestamp();
    }
    
    public function getTimestamp(){ 
        return $this->timestamp;
    }
    
   
    
}