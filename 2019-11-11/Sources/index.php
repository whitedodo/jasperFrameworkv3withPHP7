<?php

/*
 * Subject: PHP 7 - Jasper Framework v3
 * Created Date: 2019-10-28
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */

header("Content-Type: text/html; charset=UTF-8");
header('X-Frame-Options: SAMEORIGIN');  // 'X-Frame-Options'
### X-Frame-Options: Deny (iframe, file_get.... 차단되어버림.)
@extract($_GET);
@extract($_POST);
@extract($_SERVER);
@extract($_FILES);
@extract($_ENV);
@extract($_COOKIE);
@extract($_SESSION);

// 경로 설정

include 'config.php';

$realDir = $HOME_ROOT . $HOME_DIRECTORIES;
$homeDir = $HOME_DIRECTORIES;

#echo "야:" . $_SERVER['REQUEST_URI'] . "/";

// Model(모델)
include $realDir . '/model/MemberBaseModel.php';
include $realDir . '/model/RssModel.php';
include $realDir . '/model/RssInfo.php';
include $realDir . '/model/BoardModel.php';
include $realDir . '/model/CommentModel.php';
include $realDir . '/model/BoardFileModel.php';
include $realDir . '/model/BoardFilelogModel.php';

// Controller(콘트롤러)
include $realDir . '/controller/member.php';
include $realDir . '/controller/board.php';
include $realDir . '/controller/subpage.php';

// Member(회원)
include $realDir . '/application/member/MemberPost.php';
include $realDir . '/application/member/MemberDB.php';

// Board 게시판
include $realDir . '/application/board/BoardPaging.php';
include $realDir . '/application/board/BoardDB.php';
include $realDir . '/application/board/BoardFunction.php';
include $realDir . '/application/board/BoardRSS.php';
include $realDir . '/application/board/BoardPost.php';         // 글쓰기, 삭제, 수정
include $realDir . '/application/board/BoardCountLogic.php';   // 조회수 로직
include $realDir . '/application/board/BoardDownloader.php';   // 다운로더

// JasperSystem
include $realDir . '/application/system/Xss.php';
include $realDir . '/application/system/OldPHP_AES256.php';
include $realDir . '/application/system/AES256.php';
include $realDir . '/application/system/JasperFunction.php';
include $realDir . '/application/JasperSystem.php';
include $realDir . '/application/system/database/MyConnect.php';

// 문자열 추출
$startPosString = 'index.php';
$startPos = strpos($_SERVER['REQUEST_URI'], $startPosString);

if ( strpos($_SERVER['REQUEST_URI'], $startPosString) ){
    $indexPos = ($startPos * 2) - 2;
}else{
    $indexPos = ($startPos * 2) - 1;
}

// 분해
$endPos = 2048;                     // 임의의 byte 수
$arrPostVal = '';

$arrPostVal = substr($_SERVER['REQUEST_URI'], $indexPos, $endPos);
$arrPostVal = explode("/", $arrPostVal);

// DB 연동
#$connect = new Connect($MYSQL_HOSTNAME, $MYSQL_USERNAME, 
#                        $MYSQL_PASSWORD, $MYSQL_DATABASE, $MYSQL_PORT);

$conn = new MyConnect();
$conn->setHostname($MYSQL_HOSTNAME);
$conn->setUsername($MYSQL_USERNAME);
$conn->setPassword($MYSQL_PASSWORD);
$conn->setDatabase($MYSQL_DATABASE);
$conn->setPort($MYSQL_PORT);
$conn->setCharset($MYSQL_CHARSET);

// 검색 키워드(공통)
$keyword = $_GET['keyword'];

// 홈페이지 실행 영역
$index = 1;

$jasperFramework = new JasperSystem($index, $arrPostVal, $conn);
$jasperFramework->setRealDir($realDir);
$jasperFramework->setHomeDir($homeDir);
$jasperFramework->setSwIndexURI($HOME_DIRECTORIES);
$jasperFramework->setKeyword($keyword);
$jasperFramework->setBoardElem($BOARD_ELEMENT);
$jasperFramework->setBoardUpdateRemove($BOARD_MODIFY_MODE, $BOARD_REMOVE_MODE);
$jasperFramework->setBoardProtectedMode($BOARD_PROTECTED_MODE);
$jasperFramework->setCommentElem($COMMENT_ELEMENT);
$jasperFramework->setCommentTypeMode($COMMENT_TYPE_MODE);
$jasperFramework->setMemberElem($MEMBER_BASE_MODEL);
$jasperFramework->setMemberJoinMode($MEMBER_JOIN_OK);
$jasperFramework->setMemberLoginMode($MEMBER_LOGIN_OK);
$jasperFramework->setMemberOpenAPILoginMode($MEMBER_OPENAPI_OK);
$jasperFramework->setMemberMyinfoMode($MEMBER_MYINFO_OK);
$jasperFramework->setMemberWithdrawalMode($MEMBER_WITHDRAWAL_OK);

$jasperFramework->run();

$jasperFramework->__destruct();

?>