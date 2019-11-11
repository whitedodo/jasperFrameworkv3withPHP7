<?php

/*
 * Subject: PHP 7 - RSSInfo
 * FileName: RSSInfo.php
 * Created Date: 2019-10-31
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */

class RSSInfo{
    
    private $title;
    private $link;
    private $description;
    private $pubDate;
    
    // getter & setter
    public function getTitle(){
        return $this->title;
    }
    
    public function getLink(){
        return $this->link;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getPubDate(){
        return $this->pubDate;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function setLink($link){
        $this->link = $link;
    }
    
    public function setDescription($description){
        $this->description = $description;
    }
    
    public function setPubDate($pubDate){
        $this->pubDate = $pubDate;
    }
    
}

?>