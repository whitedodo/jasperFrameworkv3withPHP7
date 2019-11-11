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
    
    public function getSwIndexURI(){
        return $this->swIndexURI;
    }
    
    public function setSwIndexURI($url){
        
        if ( $url === ''){
            $this->swIndexURI = 2;
        }
        else{
            $this->swIndexURI = 1;
        }
        
        
    }
    
    public function run(){
        
        $arrPostVal = $this->arrPostVal;
        
        $this->createObject($arrPostVal);
        
        #echo $this->firstURI;
        
        if (strpos($this->firstURI, "login_session") === 0 ){
            
            # 세션을 시작하면 반드시 선언할 것
            session_start();            
            
            $this->login_session();
        }
        else if (strpos($this->firstURI, "login_cookie") === 0){
            $this->login_cookie();
        }
        else if (strpos($this->firstURI, "login") === 0){
            
        }
        else if (strpos($this->firstURI, "board") === 0){
            $this->board();   
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
                        #echo '참';
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
    
    private function board(){
        
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
            }
            
        }
        else if ( strpos($boardFunc, "modify") ===0){
            
            session_cache_expire(120);               // 2시간
            session_start();
            
            $state = 0;
            $boardDB = new BoardDB($connect, $boardName);
            $boardElem = $boardDB->view($pageId);
            $mode = $boardElem->getMode();
            
            $protectType = 'none';
            $protectResult = 'none';
            
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
                    $protectType = $_SESSION['protectType'];
                    $protectResult = $_SESSION['protectResult'];
                    
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
            
        }
        
        else if (strpos($boardFunc, "remove") === 0){
            
            if ( strlen($boardRemoveMode) === 0 ){
                $board->remove($pageId);
            }else{
                
                $boardDB = new BoardDB($connect, $boardName);
                
                if ( $boardDB->isContent($pageId) )
                    $board->remove_ok($pageId, $boardElem);
                else{
                    
                }
                
            }
            
        }
        else if (strpos($boardFunc, "view") === 0){
            
            #echo $commentTypeMode . "/". strcmp($commentTypeMode, 'd');
            
            session_cache_expire(120);               // 2시간
            session_start();
            
            $state = 0;
            $boardDB = new BoardDB($connect, $boardName);
            $boardElem = $boardDB->view($pageId);
            $mode = $boardElem->getMode();
            
            $protectType = 'none';
            $protectResult = 'none';
            
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
                $protectType = $_SESSION['protectType'];
                $protectResult = $_SESSION['protectResult'];
                
            }
            
            // 글 읽기 기능 수행(보호 글)
            if ( strcmp($_SESSION['protectType'], 'read') == 0 &&
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
                $board->protected($pageId);
                $state = 0;
            }else{
                $state = 1;
            }
            
            #echo $_SESSION['protectType'];
            
            # echo $state;
            
            if ( $state === 1){
                $board->protected_read_ok($pageId, $boardElem, $boardProtectedMode );
            }
            
            
        }
        else if (strpos($boardFunc, "list") === 0){

            if ( is_null( $pageId ) )
            {
                header("location:" . $_SERVER['REQUEST_URI'] . "/");
            }
            else{
                $board->list('게시판 목록', $pageId);
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