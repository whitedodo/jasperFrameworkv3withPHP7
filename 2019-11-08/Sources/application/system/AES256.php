<?php

/*
 Subject: PHP 7.3 with OpenSSL (AES256 암호패키지)
 FileName: AES256.php
 Created Date: 2019-11-08
 Author: Dodo (rabbit.white@daum.net)
 Description:
 
 */

class AES256{
    
    private $iv;
    private $password;
    
    public function __construct(){
        $this->iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        $this->password = 'rabbit2me';
    }
    
    public function __destruct(){
        unset($this->iv);
        unset($this->password);
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function setPassword($password){
        
        $this->password = $password;
    }
    
    public function encode($plainText){
        
        $iv = $this->iv;
        $password = $this->password;
        
        $encrypted = base64_encode(openssl_encrypt($plainText, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
        
        return $encrypted;
        
    }
    
    public function decode($encrypted){
        
        $iv = $this->iv;
        $password = $this->password;
        
        $decrypted = openssl_decrypt(base64_decode($encrypted), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }
    
}