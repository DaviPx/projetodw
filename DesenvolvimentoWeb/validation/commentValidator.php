<?php

class commentValidator {
    
    public function isCommentValid($user,$text) { // UM COMENTARIO NAO PODE SER CRIADO SE NAO TIVER USUARIO OU CORPO
        if($user ==  null || $text == null){
            return false;
        }
        return true;
    }
    
}