<?php

/*
 Subject: PHP 7.3 with OpenSSL (AES256 암호패키지)
 FileName: AES256.php
 Created Date: 2019-11-08
 Author: Dodo (rabbit.white@daum.net)
 Description:
 
 */

class AES256{
    
    private $ivBytes;
    private $secretKey;
    
    public function __construct(){
        $this->ivBytes = chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0);
        $this->secretKey = 'rabbit2me1234567';
    }
    
    public function __destruct(){
        unset($this->ivBytes);
        unset($this->secretKey);
    }
    
    public function getSecretKey(){
        return $this->secretKey;
    }
    
    public function setSecretKey($secretKey){
        
        $this->secretKey = $secretKey;
    }
    
    public function encode($plainText){
        
        $iv = $this->ivBytes;
        $secret_key = $this->secretKey;
        
        return @base64_encode(openssl_encrypt($plainText, "aes-256-cbc", $secret_key, OPENSSL_RAW_DATA, $iv)); 
        
    }
    
    public function decode($encrypted){
        
        $iv = $this->ivBytes;
        $secret_key = $this->secretKey;
        
        return @openssl_decrypt(base64_decode($encrypted), "aes-256-cbc", $secret_key, OPENSSL_RAW_DATA, $iv);
    }
    
}