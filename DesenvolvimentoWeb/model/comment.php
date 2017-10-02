<?php


require_once("validation/commentValidator.php");
require_once ("exception/requestException.php");


class Comment {
    private $test;
    private $title;
    private $text;
    private $points; //  COMO SE FOSSE LIKE, SO QUE COM OPCAO NEGATIVA
    private $username;
    private $timestamp;
    private $cv;
    
    public function __construct($test,$title,$text,$userName) {
        $this->cv=new CommentValidator();
        $this->test= $test;
        $this->title= $title;
        $this->text = $text;
        $this->userName = $userName;
        $this->points = 0; // NAO HAVERA PONTOS QUANDO O COMENTARIO FOR INICIADO
       $this->timestamp = $this->setTimestamp();
        
    }
    
    
    public function getTest()
    {
        return $this->test;
    }

   
    public function getPoints()
    {
        return $this->points;
    }

    
    public function getUsername()
    {
        return $this->username;
    }

    
    public function getCv()
    {
        return $this->cv;
    }

   
    public function setPoints($points)
    {
        $this->points = $points;
    }

    
    

    public function getId(){ // ID E UNICO, N PODE SER SETADO DPS
        return $this->id;
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