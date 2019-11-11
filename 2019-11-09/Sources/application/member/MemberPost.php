<?php

/*
 * Subject: memberPost에 대한 정립
 * File: memberPost.php
 * Created Date: 2019-11-08
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 * 
*/

### 회원 기본 정보

$MEMBER_BASE_ID = $_POST["id"];
$MEMBER_BASE_EMAIL = $_POST["email"];
$MEMBER_BASE_PASSWD = $_POST["passwd"];
$MEMBER_BASE_PASSWD1 = $_POST["passwd1"];
$MEMBER_BASE_PASSWD2 = $_POST["passwd2"];
$MEMBER_BASE_NAME = $_POST["name"];
$MEMBER_BASE_NICKNAME = $_POST["nickname"];
$MEMBER_BASE_LEVEL = $_POST["level"];
$MEMBER_BASE_SEX = $_POST["sex"];
$MEMBER_BASE_BIRTHDATE = $_POST["birthdate"];
$MEMBER_BASE_REGIDATE = $_POST["regidate"];
$MEMBER_BASE_IP = $_POST["ip"];

$MEMBER_JOIN_OK = $_POST["member_ok"];
$MEMBER_LOGIN_OK = $_POST["login_ok"];

### 회원 - 비밀번호
if ( strcmp( $MEMBER_BASE_PASSWD1, $MEMBER_BASE_PASSWD2) === 0 && 
    ( $MEMBER_BASE_PASSWD1 != 0 && $MEMBER_BASE_PASSWD2 != 0) ){
        
    #echo "참1";
    $MEMBER_BASE_PASSWD = $MEMBER_BASE_PASSWD1;
    
}else if ( strcmp( $MEMBER_BASE_PASSWD1, $MEMBER_BASE_PASSWD2 ) === -1 ){
    #echo "참2";
    
    $MEMBER_BASE_PASSWD = -1;
}else if ( $MEMBER_LOGIN_OK === 1){
    #echo "참3";
}
else{
    #echo "참4";
}


### 회원 모델 입력

$MEMBER_BASE_MODEL = new MemberBaseModel();
$MEMBER_BASE_MODEL->setId($MEMBER_BASE_ID);
$MEMBER_BASE_MODEL->setEmail($MEMBER_BASE_EMAIL);
$MEMBER_BASE_MODEL->setPasswd($MEMBER_BASE_PASSWD);
$MEMBER_BASE_MODEL->setName($MEMBER_BASE_NAME);
$MEMBER_BASE_MODEL->setNickname($MEMBER_BASE_NICKNAME);
$MEMBER_BASE_MODEL->setLevel($MEMBER_BASE_LEVEL);
$MEMBER_BASE_MODEL->setSex($MEMBER_BASE_SEX);
$MEMBER_BASE_MODEL->setBirthdate($MEMBER_BASE_BIRTHDATE);
$MEMBER_BASE_MODEL->setRegidate($MEMBER_BASE_REGIDATE);
$MEMBER_BASE_MODEL->setIp($MEMBER_BASE_IP);

?>