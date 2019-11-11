<?php

class RSSModel{
  
    private $author;
    private $category;
    private $title;
    private $link;
    private $guid;
    private $pubDate;
    private $description;
    
    // getter & setter
    public function getAuthor(){
      return $this->author;
    }
    
    public function getCategory(){
      return $this->category;
    }
    
    public function getTitle(){
      return $this->title;
    }
    
    public function getLink(){
      return $this->link;
    }
    
    public function getGuid(){
      return $this->guid;
    }
    
    public function getPubDate(){
      return $this->pubDate;
    }
    
    public function getDescription(){
      return $this->description;
    }
    
    public function setAuthor($author){
      $this->author = $author;
    }
    
    public function setCategory($category){
      $this->category = $category;
    }
    
    public function setTitle($title){
      $this->title = $title;
    }
    
    public function setLink($link){
      $this->link = $link;
    }
    
    public function setGuid($guid){
      $this->guid = $guid;
    }
    
    public function setPubDate($pubDate){
      $this->pubDate = $pubDate;
    }
    
    public function setDescription($description){
      $this->description = $description;
    }
            
  }
?>