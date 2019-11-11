<?php

class BoardCommentDB{
    
    private $connect;
    private $boardName;
    private $articleId;
    
    public function __construct($connect, $boardName, $articleId){
        
        $this->connect = $connect;
        $this->boardName = $boardName;
        
    }
    
    public function __destruct(){
        unset($this->connect);
        unset($this->boardName);
        unset($this->articleId);
    }
    
    public function listView(){
        
        
    }
    
    
}

?>