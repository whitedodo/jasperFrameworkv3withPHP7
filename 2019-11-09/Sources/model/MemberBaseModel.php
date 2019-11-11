<?php

/*
 * Subject: PHP 7 - 회원기본정보
 * Created Date: 2019-11-08
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */

class MemberBaseModel{
    
    private $id;            // 일련번호
    private $email;         // 이메일 주소
    private $passwd;        // 비밀번호
    private $name;          // 회원 이름
    private $nickname;      // 닉네임
    private $level;         // 회원 등급
    private $sex;           // 성별
    private $birthdate;     // 생년월일
    private $regidate;      // 등록일자
    private $ip;            // 등록 IP주소
    
    public function getId(){
        return $this->id;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getPasswd(){
        return $this->passwd;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getNickname(){
        return $this->nickname;
    }
    
    public function getLevel(){
        return $this->level;
    }
    
    public function getSex(){
        return $this->sex;
    }
    
    public function getBirthdate(){
        return $this->birthdate;
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
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setPasswd($passwd){
        $this->passwd = $passwd;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function setNickname($nickname){
        $this->nickname = $nickname;
    }
    
    public function setLevel($level){
        $this->level = $level;
    }
    
    public function setSex($sex){
        $this->sex = $sex;
    }
    
    public function setBirthdate($birthdate){
        $this->birthdate = $birthdate;
    }
    
    public function setRegidate($regidate){
        $this->regidate = $regidate;
    }
    
    public function setIp($ip) {
        $this->ip = $ip;
    }
    
}

?>