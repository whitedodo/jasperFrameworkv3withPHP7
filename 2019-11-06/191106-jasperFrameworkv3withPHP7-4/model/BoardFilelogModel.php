<?php

/*
 * Subject: PHP 7 - 파일 로그
 * Created Date: 2019-10-28
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */

class BoardFilelogModel{
    
    private $id;
    private $articleId;
    private $fileId;
    private $ip;
    private $regidate;
    
    public function getId(){
        return $this->id;
    }
    
    public function getArticleId(){
        return $this->articleId;
    }
    
    public function getFileId(){
        return $this->fileId;
    }
    
    public function getIp(){
        return $this->ip;
    }
    
    public function getRegidate(){
        return $this->regidate;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setArticle($articleId){
        $this->articleId = $articleId;
    }
    
    public function setFileId($fileId){
        $this->fileId = $fileId;
    }
    
    public function setIp($ip){
        $this->ip = $ip;
    }
    
    public function setRegidate($regidate){
        $this->regidate = $regidate;
    }
    
}

?>