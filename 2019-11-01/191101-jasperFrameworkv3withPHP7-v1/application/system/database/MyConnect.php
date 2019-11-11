<?php
/*
	2019-08-31
	Author: Jasper(rabbit.white@daum.net)
	FileName: connect.php
	Goal: 
	Description:	
*/

class MyConnect{
	
	private $host;
	private $user;
	private $pw;
	private $dbName;
	private $port;
	private $charset;
	
	public function __construct(){
		$this->host = 'localhost';
		$this->user = '';
		$this->pw = '';
		$this->dbName = '';
		$this->port = 3306;
		$this->charset = 'utf8';
		
	}
	
	public function __destruct(){
	    unset($this->host);
	    unset($this->user);
	    unset($this->pw);
	    unset($this->dbName);
	    unset($this->port);
	    unset($this->charset);
	}
	
	public function getHostname(){
		return $this->host;	
	}
	
	public function getUsername(){
		return $this->user;	
	}
	
	public function getPassword(){
		return $this->pw;
	}
	
	public function getDatabase(){
		return $this->dbName;
	}
	
	public function getPort(){
	    return $this->port;
	}
	
	public function getCharset(){
	    return $this->charset;
	}
	
	public function setHostname($host){
	    $this->host = $host;
	}
	
	public function setUsername($user){
	    $this->user = $user;
	}
	
	public function setPassword($pw){
	    $this->pw = $pw;
	}
	
	public function setDatabase($dbName){
	    $this->dbName = $dbName;
	}
	
	public function setPort($port){
	    $this->port = $port;
	}
	
	public function setCharset($charset){
	    $this->charset = $charset;
	}
	
}
?>