<?php

/*
 * Subject: PHP 7 - Jasper Framework v3
 * Created Date: 2019-10-28
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 * 1. 2019-11-02 / Jasper / 댓글 기능 추가(글쓰기, 목록)
 */

### 게시물 포스트
$BOARD_MEMBERID = $_POST['memberId'];
$BOARD_CATEGORY = $_POST['category'];
$BOARD_MODE = $_POST['mode'];
$BOARD_SUBJECT = $_POST['subject'];
$BOARD_AUTHOR = $_POST['author'];
$BOARD_PASSWD = null;
$BOARD_PASSWD1 = $_POST['passwd1'];
$BOARD_PASSWD2 = $_POST['passwd2'];
$BOARD_MEMO = $_POST['memo'];
$BOARD_REGIDATE = date("Y-m-d H:i:s");
$BOARD_COMMENTCNT = 0;
$BOARD_IP = $_SERVER["REMOTE_ADDR"];
$BOARD_CNT = 0;

$BOARD_MODIFY_MODE = $_POST['modifyMode'];
$BOARD_REMOVE_MODE = $_POST['removeMode'];

### 댓글 포스트
$COMMENT_ARTICLEID = $_POST['articleId'];
$COMMENT_MEMBERID = $_POST['memberId'];
$COMMENT_AUTHOR = $_POST['author'];
$COMMENT_PASSWD = null;
$COMMENT_PASSWD1 = $_POST['passwd1'];
$COMMENT_PASSWD2 = $_POST['passwd2'];
$COMMENT_MEMO = $_POST['memo'];
$COMMENT_REGIDATE = date("Y-m-d H:i:s");
$COMMENT_IP = $_SERVER["REMOTE_ADDR"];

$COMMENT_WRITE_MODE = $_POST['writeMode'];
$COMMENT_MODIFY_MODE = $_POST['modifyMode'];
$COMMENT_REMOVE_MODE = $_POST['removeMode'];

### 게시글 글쓰기 모드 - 비밀번호
if ( $BOARD_PASSWD1 === $BOARD_PASSWD2 ){
    $BOARD_PASSWD = $BOARD_PASSWD1;
    
}else if ($BOARD_PASSWD1 !== $BOARD_PASSWD2 ){
    $BOARD_PASSWD = -1;
}else{
    
}

#echo "야" . $_POST['passwd1'] . "/" . $_POST['passwd2'];

### 댓글 글쓰기 모드 - 비밀번호
if ( $COMMENT_PASSWD1 === $COMMENT_PASSWD2 ){
    #echo "참";
    $COMMENT_PASSWD = $COMMENT_PASSWD1;
    
}else if ($COMMENT_PASSWD1 !== $COMMENT_PASSWD2 ){
    #echo "거짓";
    $COMMENT_PASSWD = -1;
}else{
    
}

### 수정 모드 또는 삭제 모드(게시물)
if ( $BOARD_MODIFY_MODE == 1 || 
     $BOARD_REMOVE_MODE == 1)
{
    $BOARD_PASSWD = $_POST['passwd'];
}


### 수정 모드 또는 삭제 모드(댓글)
if ($COMMENT_MODIFY_MODE == 1 ||
    $COMMENT_REMOVE_MODE == 1)
{
    $COMMENT_PASSWD = $_POST['passwd'];
}

### 게시물 모델
$BOARD_ELEMENT = new BoardModel();

$BOARD_ELEMENT->setMemberId($BOARD_MEMBERID);
$BOARD_ELEMENT->setCategory($BOARD_CATEGORY);
$BOARD_ELEMENT->setMode($BOARD_MODE);
$BOARD_ELEMENT->setSubject($BOARD_SUBJECT);
$BOARD_ELEMENT->setAuthor($BOARD_AUTHOR);
$BOARD_ELEMENT->setPasswd($BOARD_PASSWD);
$BOARD_ELEMENT->setSubject($BOARD_SUBJECT);
$BOARD_ELEMENT->setMemo($BOARD_MEMO);
$BOARD_ELEMENT->setRegidate($BOARD_REGIDATE);
$BOARD_ELEMENT->setCommentCnt($BOARD_COMMENTCNT);
$BOARD_ELEMENT->setIp($BOARD_IP);
$BOARD_ELEMENT->setCnt($BOARD_CNT);

//echo $BOARD_AUTHOR;

### 댓글 모델
$COMMENT_ELEMENT = new CommentModel();

$COMMENT_ELEMENT->setAuthor($COMMENT_AUTHOR);
$COMMENT_ELEMENT->setArticleId($COMMENT_ARTICLEID);
$COMMENT_ELEMENT->setMemberId($COMMENT_MEMBERID);
$COMMENT_ELEMENT->setAuthor($COMMENT_AUTHOR);
$COMMENT_ELEMENT->setPasswd($COMMENT_PASSWD);
$COMMENT_ELEMENT->setMemo($COMMENT_MEMO);
$COMMENT_ELEMENT->setRegidate($COMMENT_REGIDATE);
$COMMENT_ELEMENT->setIp($COMMENT_IP);

?>