<?php

/*
 * Subject: PHP 7 - JasperSystem
 * File: JasperSystem.php
 * Created Date: 2019-10-28
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */

class JasperSystem{
    
    private $index;
    private $arrPostVal;
    
    // Directories
    private $realDir;
    private $homeDir;
    
    // URI
    private $firstURI;
    private $secondURI;
    private $thirdURI;
    private $fourURI;
    private $fiveURI;
    
    private $swIndexURI;
    
    // Queries
    private $keyword;
    
    // Board
    private $boardElem;
    private $boardModifyMode;
    private $boardRemoveMode;
    private $boardProtectedMode;
    
    // Board with Comment
    private $commentElem;
    private $commentTypeMode;
    
    // Member
    private $memberElem;
    private $memberJoinMode;
    private $memberLoginMode;
    private $memberOpenAPILoginMode;
    
    // Database
    private $connect;
    
    public function __construct($index, $arrPostVal, $connect){
        
        // Object
        $this->index = $index;
        $this->arrPostVal = $arrPostVal;
        $this->connect = $connect;
        
        // URI
        $this->firstURI = null;
        $this->secondURI = null;
        $this->thirdURI = null;
        $this->fourURI = null;
        $this->fiveURI = null;
        $this->swIndexURI = null;
        
        // Keyword
        $this->keyword = null;
        
        // Board
        $this->boardElem = null;
        $this->boardModifyMode = null;
        $this->boardRemoveMode = null;
        $this->boardProtectedMode = null;
        
        // Board with Comment
        $this->commentElem = null;
        $this->commentTypeMode = null;
        
        // Member
        $this->memberJoinMode = null;
        $this->memberLoginMode = null;
        $this->memberOpenAPILoginMode = null;
        
    }
    
    public function __destruct(){
        
        // Object
        unset($this->index);
        unset($this->arrPostVal);
        unset($this->connect);
        
        // URI
        unset($this->firstURI);
        unset($this->secondURI);
        unset($this->thirdURI);
        unset($this->fourURI);
        unset($this->fiveURI);
        unset($this->swIndexURI);
        
        // RealDir
        unset($this->realDir);
        
        // Keyword
        unset($this->keyword);
        
        // Board
        unset($this->boardElem);
        unset($this->boardModifyMode);
        unset($this->boardRemoveMode);
        unset($this->boardProtectedMode);
        
        // Board with Comment
        unset($this->commentElem);
        unset($this->commentTypeMode);
        
        // Member
        unset($this->memberJoinMode);
        unset($this->memberLoginMode);
        unset($this->memberOpenAPILoginMode);
        
    }
    
    public function getRealDir(){
        return $this->realDir;
    }
    
    public function setRealDir($realDir){
        $this->realDir = $realDir;
    }
    
    public function getHomeDir(){
        return $this->homeDir;
    }
    
    public function setHomeDir($homeDir){
        $this->homeDir = $homeDir;
    }
    
    public function getKeyword(){
        return $this->keyword;
    }
    
    public function setKeyword($keyword){
        $this->keyword = $keyword;
    }
    
    public function getBoardElem(){
        return $this->boardElem;
    }
    
    public function setBoardElem($boardElem){
        $this->boardElem = $boardElem;
    }
    
    public function getBoardModifyMode(){
        return $this->boardModifyMode;
    }
    
    public function setBoardModifyMode($boardModifyMode){
        $this->boardModifyMode = $boardModifyMode;
    }
    
    public function getBoardRemoveMode(){
        return $this->boardRemoveMode;
    }
    
    public function setBoardRemoveMode($boardRemoveMode){
        return $this->boardRemoveMode;
    }
    
    public function getBoardProtectedMode(){
        return $this->boardProtectedMode;
    }
    
    public function setBoardProtectedMode($boardProtectedMode){
        $this->boardProtectedMode = $boardProtectedMode;
    }
    
    public function setBoardUpdateRemove($boardModifyMode, $boardRemoveMode){
        $this->boardModifyMode = $boardModifyMode;
        $this->boardRemoveMode = $boardRemoveMode;
    }
    
    public function getCommentElem(){
        return $this->commentElem;
    }
    
    public function setCommentElem($commentElem){
        $this->commentElem = $commentElem;
    }
    
    public function getCommentTypeMode(){
        return $this->commentTypeMode;
    }
    
    public function setCommentTypeMode($commentTypeMode){
        $this->commentTypeMode = $commentTypeMode;
    }
    
    public function getMemberElem(){
        return $this->memberElem;
    }
    
    public function setMemberElem($memberElem){
        $this->memberElem = $memberElem;
    }
    
    public function getMemberJoinMode(){
        return $this->memberJoinMode;
    }
    
    public function setMemberJoinMode($memberJoinMode){
        $this->memberJoinMode = $memberJoinMode;
    }
    
    public function getMemberLoginMode(){
        return $this->memberLoginMode;
    }
    
    public function setMemberLoginMode($memberLoginMode){
        $this->memberLoginMode = $memberLoginMode;
    }
    
    public function getMemberOpenAPILoginMode(){
        return $this->memberOpenAPILoginMode;
    }
    
    public function setMemberOpenAPILoginMode($memberOpenAPILoginMode){
        $this->memberOpenAPILoginMode = $memberOpenAPILoginMode;
    }
    
    public function getSwIndexURI(){
        return $this->swIndexURI;
    }
    
    public function setSwIndexURI($url){
        
        if ( $url === ''){
            $this->swIndexURI = 2;
        }
        else{
            $this->swIndexURI = 1;
        } // end of if
        
    }
    
    public function run(){
        
        $arrPostVal = $this->arrPostVal;
        $this->createObject($arrPostVal);
        $this->appGo();
    }
    
    private function appGo(){
        
        #echo $this->firstURI . "/" . empty($this->firstURI);
        
        if (strpos($this->firstURI, "login_session") === 0 ){
            $this->login_session();
        }
        else if (strpos($this->firstURI, "login_cookie") === 0){
            $this->login_cookie();
        }
        else if (strpos($this->firstURI, "login") === 0){
            
        }
        else if (strpos($this->firstURI, "board") === 0){
            $this->boardPage();
        }
        else if ( empty($this->firstURI) == 1 ){
            $this->indexPage();
        }
        else if (strpos($this->firstURI, "homepage") === 0 ){
            $this->subPage();
        }else if (strpos($this->firstURI, "member") === 0){
            $this->memberPage();
        }
        
    }
    
    private function createObject($arrPostVal){
        
        $index = 1;
        $swIndexURI = $this->getSwIndexURI();
        
        foreach ($arrPostVal as $value){
            
            // 홈 디렉토리가 있는 경우
            if ( $swIndexURI === 1 ){
            
                switch ( $index ){
                    
                    case 1:
                        $this->firstURI = $value;
                        break;
                        
                    case 2:
                        $this->secondURI = $value;
                        break;
                        
                    case 3:
                        $this->thirdURI = $value;
                        break;
                        
                    case 4:
                        $this->fourURI = $value;
                        break;
                    
                    case 5:
                        $this->fiveURI = $value;
                        break;
                        
                    default:
                        
                        break;
                        
                } // end of switch
            
            }
            // 홈 디렉토리가 없는 경우
            else if ( $swIndexURI === 2 ){
                
                switch ( $index ){
                    
                    case 3:
                        $this->firstURI = $value;
                        break;
                        
                    case 4:
                        $this->secondURI = $value;
                        break;
                        
                    case 5:
                        $this->thirdURI = $value;
                        break;
                        
                    case 6:
                        $this->fourURI = $value;
                        break;
                        
                    case 7:
                        $this->fiveURI = $value;
                        break;
                        
                    default:
                        
                        break;
                        
                } // end of switch
                
            } // end of if
            
            $index++;
        }
        
    }
    
    private function login_session(){
        
        // echo "로그인 기능";
        // echo $_REQUEST['id'];
        
        if ( isset($_REQUEST['id']) &&
            isset($_REQUEST['passwd'])){
                
                # 세션 로그인
                $_SESSION['id'] = $_REQUEST['id'];
                $_SESSION['login_time'] = date('Y-m-d');
                
                echo "<script> alert('login success'); </script>";
                
        }else{
            echo "<script>alert('login failed')</script>";
            
        }
        
    }
    
    private function login_cookie(){
        
        // echo "로그인 기능";
        // echo $_REQUEST['id'];
        
        if ( isset($_REQUEST['id']) &&
            isset($_REQUEST['passwd'])){
                
                # 쿠키 로그인
                setcookie("id", $_REQUEST['id'], time() + 86300, "/");
                setcookie("login_time", time(), time() + 86300, "/");
                setcookie("token", md5($_REQUEST['pw']), time() + 86300, "/");
                
                echo "<script> alert('login success'); </script>";
                
        }else{
            echo "<script>alert('login failed')</script>";
            
        }
        
    }
    
    private function indexPage(){
        
        ### 연결
        $conn = $this->connect;
        ### Directories
        $realDir = $this->getRealDir();
        $homeDir = $this->getHomeDir();
        #echo "하하하하1";
        #print_r($conn);
        
        $subpage = new SubPage($conn, $realDir, $homeDir);
        
        #echo "하하하하2";
        $subpage->index();
        #echo "하하하하3";
        
    }
    
    private function subPage(){
        
        $subPage = $this->secondURI;
        
        ### 연결
        $connect = $this->connect;
        
        ### Directories
        $realDir = $this->getRealDir();
        $homeDir = $this->getHomeDir();
        
        $subpage = new SubPage($connect, $realDir, $homeDir);
        
        if (strpos($subPage, "about") === 0){
            $subpage->about();
        }
        else if ( strpos($subPage, "history") === 0 ){
            $subpage->history();
        }
        else if ( strpos($subPage, "latestArticle") === 0 ){
            $subpage->latestArticle();            
        }
        
    }
    
    private function memberPage(){
        
        session_start();
        $subPage = $this->secondURI;
        
        ### 회원 기본 정보
        $memberElem = $this->getMemberElem();
        $memberJoinMode = $this->getMemberJoinMode();
        $memberLoginMode = $this->getMemberLoginMode();
        
        ### 연결
        $connect = $this->connect;
        
        ### Directories
        $realDir = $this->getRealDir();
        $homeDir = $this->getHomeDir();
        
        $member = new Member($connect, $realDir, $homeDir);
        
        if (strpos($subPage, "login") === 0){
                        
            $state = 0;
            #echo "참1 <br>";
            // 세션 존재하지 않을 떄
            if ( !isset($_SESSION["email"]) &&
                 !isset($_SESSION["login_time"]) &&
                 !isset($_SESSION["level"])){
                $state--;
                #echo "참2 <br>";
            }else{
                $state++;
                #echo "참3 <br>";
            }
            
            #echo "참4 <br>";
            // 로그인 시도일 때
            if ( $memberLoginMode == 1){
                $state++;
                #echo "참5 <br>";
            }else{
                $state--;
                #echo "참6 <br>";
            }
            #echo "참7 <br>";
            #echo "[세션]" . $state . "/" . $_SESSION["email"] . "<br>";
            
            if ($state == -2){
                $member->login();
            }
            else if ($state == 0 && 
                strlen($memberElem->getEmail()) !== 0 &&
                strlen($memberElem->getPasswd()) !== 0){
                $member->login_ok($memberElem);
            }
            else if (isset($_SESSION["email"])){
                echo "로그인 상태<br>";
                echo "<a href='logout'>로그아웃</a><br>";
                echo "<a href='../../'>홈</a>";
            }else{
                $member->login_ok($memberElem);
            }
            
            
        }
        else if (strpos($subPage, "logout") === 0){
            session_destroy();
            header("location:" . "login");
        }
        else if (strpos($subPage, "join") === 0 ){
            
            #echo $memberJoinMode . "참";
            
            if ( $memberJoinMode == 1 ){
                // 회원가입 처리중일 때
                $member->join_ok($memberElem);
            }else{
                // 회원가입
                $member->join();
            }
        }
        else if (strpos($subPage, "openapi") === 0){
            $member->openapi_login_ok($memberElem);
        }
        
    }
    
    private function boardPage(){
        
        $boardName = $this->secondURI;
        $boardFunc = $this->thirdURI;
        $pageId = $this->fourURI;
        $keyword = $this->keyword;
        
        ### 연결
        $connect = $this->connect;
        
        ### Directories
        $realDir = $this->getRealDir();
        $homeDir = $this->getHomeDir();
        
        ### Board Element(게시판 원소)
        $boardElem = $this->getBoardElem();
        $boardModifyMode = $this->getBoardModifyMode();
        $boardRemoveMode = $this->getBoardRemoveMode();
        $boardProtectedMode = $this->getBoardProtectedMode();
        
        ### Board with Comment Element(게시물 댓글 원소)
        $commentElem = $this->getCommentElem();
        $commentTypeMode = $this->getCommentTypeMode();
        
        #echo $pageId;
        
        ### URL
        $rssURL = $homeDir . "/index.php/board/";
        #echo $rssURL;
        
        $board = new Board($connect, $realDir, $homeDir);
        $board->setBoardName($boardName);
        $board->setKeyword($keyword);
        
        $boardRss = new BoardRSS($boardName, $rssURL, $connect);

        
        if ( strpos( $boardFunc, "write" ) === 0){
            
            $subject = $boardElem->getSubject();
            
            if ( strlen($subject) === 0 )
                $board->write();
            else{
                $board->write_ok($boardElem);
            } // end of if
            
        }
        else if ( strpos($boardFunc, "modify") ===0){
            
            session_cache_expire(120);               // 2시간
            session_start();
            
            $state = 0;
            $boardDB = new BoardDB($connect, $boardName);
            $boardElemDB = $boardDB->view($pageId);
            $mode = $boardElemDB->getMode();
            
            if ( strcmp($mode, 'protected') === 0 ){
                $state = 0;
            }
            else{
                $state = 1;
            }
            
            // 세션 생성하기
            if ( !isset( $_SESSION['protectType'] ) &&
                $state === 0) {
                $_SESSION['protectType'] = 'modify';
                $_SESSION['protectResult'] = 'none';
            }
            
            // 세션이 존재할 때 형식 가져오기
            if ( isset($_SESSION['protectType']) &&
                isset($_SESSION['protectResult'])){
                    
                    $_SESSION['protectType'] = 'modify';
                    
            }

            
            // 글 읽기 기능 수행(보호 글)
            if ( strcmp($_SESSION['protectType'], 'modify') == 0 &&
                strcmp($_SESSION['protectResult'], "success_" . $pageId ) == 0 ){
                    
                if ( strlen($boardModifyMode) === 0 ){
                    $board->modify($pageId);
                }
                else{
                    
                    $boardDB = new BoardDB($connect, $boardName);
                    
                    if ( $boardDB->isContent($pageId) ){
                        $board->modify_ok($pageId, $boardElem);
                    }
                    else{
                        
                    }
                    
                } // end of if
            
            }
            // 글 읽기 기능 수행(일반 글)
            else if ( $state === 1 ){
                
                if ( strlen($boardModifyMode) === 0 ){
                    $board->modify($pageId);
                }
                else{
                    
                    $boardDB = new BoardDB($connect, $boardName);
                    
                    if ( $boardDB->isContent($pageId) ){
                        $board->modify_ok($pageId, $boardElem);
                    }
                    else{
                        
                    }
                    
                } // end of if
            
            }
            // 보호 모드 실행
            else{
                
                header("location:" . "../protected/" . $pageId);
            }
            
            #session_destroy();
            
        }
        
        else if (strpos($boardFunc, "remove") === 0){
            
            session_start();
            // 관리자(운영자) 계정으로 로그인되어 있을 떄
            if ( ( isset( $_SESSION['email'] ) && isset( $_SESSION["level"] ) ) &&
                $_SESSION["level"] >= 5 )
            {   
                
                #echo "참1";
                
                if ( strlen($boardRemoveMode) === 0){
                    $board->op_remove($pageId);
                }else{
                    
                    $boardDB = new BoardDB($connect, $boardName);
                    
                    // 콘텐츠가 존재할 때
                    if ( $boardDB->isContent($pageId) )
                    {
                        #echo "참";
                        $board->op_remove_ok($pageId);
                    }
                    // 콘텐츠가 존재하지 않을때
                    else{
                        
                    } // end of if
                    
                } // end of if
                
            }
            else if ( strlen($boardRemoveMode) === 0 && 
                     isset($_SESSION['email']) ){
                
                // 참2
                $board->remove($pageId);
            }else{
                
                $boardDB = new BoardDB($connect, $boardName);
                
                // 콘텐츠가 존재할 때
                if ( $boardDB->isContent($pageId) )
                {
                    $board->remove_ok($pageId, $boardElem);
                }
                // 콘텐츠가 존재하지 않을때
                else{
                    
                } // end of if
                
            }
            
        }
        else if (strpos($boardFunc, "view") === 0){
            
            echo $_SESSION['level'];
            
            #echo $commentTypeMode . "/". strcmp($commentTypeMode, 'd');
            
            session_cache_expire(120);               // 2시간
            session_start();
            
            $state = 0;
            $boardDB = new BoardDB($connect, $boardName);
            $boardElem = $boardDB->view($pageId);
            $mode = $boardElem->getMode();
            
            
            if ( strcmp($mode, 'protected') === 0 ){
                $state = 0;
            }
            else{
                $state = 1;
            }
            
            // 세션 생성하기
            if ( !isset( $_SESSION['protectType'] ) &&
                $state === 0) {
                $_SESSION['protectType'] = 'read';
                $_SESSION['protectResult'] = 'none';
            }
            
            // 세션이 존재할 때 형식 가져오기
            if ( isset($_SESSION['protectType']) && 
                 isset($_SESSION['protectResult'])){
                
                $_SESSION['protectType'] = 'read';
                
            }
            
            #echo $_SESSION["level"] . "참";
            
            // 관리자(운영자) 계정으로 로그인되어 있을 떄
            if ( ( isset( $_SESSION['email'] ) && isset( $_SESSION["level"] ) ) &&
                   $_SESSION["level"] >= 5 ){
                       
               if ( strcmp($commentTypeMode, 'w') == 0 ){
                   $board->comment_write_ok($pageId, $commentElem);
               }
               
               else if (strcmp($commentTypeMode, 'm') === 0 ){
                   $board->comment_modify_ok($pageId, $commentElem);
               }
               
               else if (strcmp($commentTypeMode, 'd') === 0 ){
                   $board->comment_remove_ok($pageId, $commentElem);
               }
               else{
                   $board->view($pageId);
               }
                
            }
            // 글 읽기 기능 수행(보호 글)
            else if ( strcmp($_SESSION['protectType'], 'read') == 0 &&
                 strcmp($_SESSION['protectResult'], "success_" . $pageId ) == 0 ){
                     
                if ( strcmp($commentTypeMode, 'w') == 0 ){
                    $board->comment_write_ok($pageId, $commentElem);
                }
                
                else if (strcmp($commentTypeMode, 'm') === 0 ){
                    $board->comment_modify_ok($pageId, $commentElem);
                }
                
                else if (strcmp($commentTypeMode, 'd') === 0 ){
                    $board->comment_remove_ok($pageId, $commentElem);
                }
                else{
                    $board->view($pageId);
                }
                
            }
            // 글 읽기 기능 수행(일반 글)
            else if ( $state === 1 ){
                
                if ( strcmp($commentTypeMode, 'w') == 0 ){
                    $board->comment_write_ok($pageId, $commentElem);
                }
                
                else if (strcmp($commentTypeMode, 'm') === 0 ){
                    $board->comment_modify_ok($pageId, $commentElem);
                }
                
                else if (strcmp($commentTypeMode, 'd') === 0 ){
                    $board->comment_remove_ok($pageId, $commentElem);
                }
                else{
                    $board->view($pageId);
                }
                
            }
            else{
                header("location:" . "../protected/" . $pageId);
            }
            
        }
        else if ( strpos($boardFunc, "protected") === 0 ){
            
            session_start();
            
            $_SESSION['protectResult'] = 'none';
            $state = 0;
            
            if ( $boardProtectedMode === null ){
                $board->boardProtected($pageId);
                $state = 0;
            }else{
                $state = 1;
            }
            
            # echo $_SESSION['protectType'];
            
            # echo $state;
            
            if ( $state === 1){
                $board->protected_read_ok($pageId, $boardElem, $boardProtectedMode );
            }
            
        }
        else if (strpos($boardFunc, "downloader") === 0){
            
            session_start();
            
            $state = 0;
            $boardDB = new BoardDB($connect, $boardName);
            $fileElemDB = $boardDB->fileView($pageId);
            $articleId = -1;
            
            foreach ($fileElemDB as $val ){
                $articleId = $val->getArticleId();
            }
            
            $boardElemDB = $boardDB->view($articleId);
            $mode = $boardElemDB->getMode();
            
            if ( strcmp($mode, 'protected') === 0 ){
                $state = 0;
            }
            else{
                $state = 1;
            }
            
            
            // 세션 생성하기
            if ( !isset( $_SESSION['protectType'] ) &&
                $state === 0) {
                $_SESSION['protectType'] = 'read';
                $_SESSION['protectResult'] = 'none';
            }
                
            // 세션이 존재할 때 형식 가져오기
            if ( isset($_SESSION['protectType']) &&
                isset($_SESSION['protectResult'])){
                    
                $_SESSION['protectType'] = 'read';
                    
            }
            
            // 관리자(운영자) 계정으로 로그인되어 있을 떄
            if ( ( isset( $_SESSION['email'] ) && isset( $_SESSION["level"] ) ) &&
                $_SESSION["level"] >= 5 )
            {
                $board->downloader($pageId);
            }
            // 글 읽기 기능 수행(보호 글)
            if ( strcmp($_SESSION['protectType'], 'read') == 0 &&
                strcmp($_SESSION['protectResult'], "success_" . $articleId ) == 0 ){
                
                $board->downloader($pageId);
                
            }
            // 글 읽기 기능 수행(일반 글)
            else if ( $state === 1 ){
                
                $board->downloader($pageId);
            }
            else{
                header("location:" . "../protected/" . $articleId);
            }
            
        }
        else if (strpos($boardFunc, "list") === 0){
                        
            if ( is_null( $pageId ) )
            {
                header("location:" . $_SERVER['REQUEST_URI'] . "/");
            }
            else{
                $board->boardList('게시판 목록', $pageId);
            }
            
        }
        else if (strpos($boardFunc, "notice") === 0){
            
            $title = urldecode($pageId);
            
            if ( is_null( $pageId ) )
            {
                header("location:" . $_SERVER['REQUEST_URI'] . "/");
            }
            else{
                $board->noticeList($title, $pageId);
            }
            
        }
        else if (strpos($boardFunc, "rss") === 0 ){
            
            $boardRss->show();
        }
        // 오류 페이지 이동
        else{
            
        }
        
    }
    
}

?>