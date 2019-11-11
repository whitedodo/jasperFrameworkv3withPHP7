<?php

class BoardFileModel{
    
    private $id;
    private $articleId;
    private $fileName;
    private $fileExt;
    private $fileType;
    private $fileSize;
    private $uploadDir;
    private $realName;
    private $regidate;
    private $ip;
    
    public function getId(){
        return $this->id;
    }
    
    public function getArticleId(){
        return $this->articleId;
    }
    
    public function getFileName(){
        return $this->fileName;
    }
    
    public function getFileExt(){
        return $this->fileExt;
    }
    
    public function getFileType(){
        return $this->fileType;
    }
    
    public function getFileSize(){
        return $this->fileSize;
    }
    
    public function getUploadDir(){
        return $this->uploadDir;
    }
    
    public function getRealName(){
        return $this->realName;
    }
    
    public function getRegidate(){
        return $this->regidate;
    }
    
    public function getIp(){
        return $this->ip;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setArticleId($articleId){
        $this->articleId = $articleId;
    }
    
    public function setFileName($fileName){
        $this->fileName = $fileName;
    }
    
    public function setFileExt($fileExt){
        $this->fileExt = $fileExt;
    }
    
    public function setFileType($fileType){
        $this->fileType = $fileType;
    }
    
    public function setFileSize($fileSize){
        $this->fileSize = $fileSize;
    }
    
    public function setUploadDir($uploadDir){
        $this->uploadDir = $uploadDir;
    }
    
    public function setRealName($realName){
        $this->realName = $realName;
    }
    
    public function setRegidate($regidate){
        $this->regidate = $regidate;
    }
    
    public function setIp($ip){
        $this->ip = $ip;
    }
    
}

?>