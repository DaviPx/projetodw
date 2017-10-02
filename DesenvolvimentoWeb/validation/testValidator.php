<?php


class testValidator {
    
    public function isTestValid($user,$archiveLocation) { // UM TEST NAO PODE SER CRIADO SE NAO TIVER USUARIO NEM ARQUIVO "UPLODADO"
        if($user ==  null || $archiveLocation == null){
            return false;
        }
          return true;
    }
    
}