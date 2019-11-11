<?php
/*
 Subject: JasperFramework Version 3
 FileName: board.php
 Created Date: 2019-10-30
 Author: Dodo (rabbit.white@daum.net)
 Description:
 1. 2019-11-02 / Jasper / 댓글 기능 추가(글쓰기, 목록 기능 구현)
  
 */

class Board{
    
    private $conn;
    private $realDir;
    private $homeDir;
    private $boardName;
    private $keyword;
    
    public function __construct($conn, $realDir, $homeDir){
        $this->conn = $conn;
        $this->realDir = $realDir;
        $this->homeDir = $homeDir;
         
    }
    
    public function getBoardName(){
        return $this->boardName;
    }
    
    public function setBoardName($boardName){
        $this->boardName = $boardName;
    }
    
    public function getKeyword(){
        return $this->keyword;
    }
    
    public function setKeyword($keyword){
        $this->keyword = $keyword;
    }
    
    public function list($title, $pageId){
        
        $myConnect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        $boardDB = new BoardDB($myConnect, $boardName);
        
        $keyword = $this->getKeyword();
        $boardFn = new BoardFunction();
        
        $state = $boardDB->isTable();
        
        if ( $state ){
            
            #echo $keyword;
            $boardDB->listPaging( $pageId, $keyword );
            $stack = $boardDB->listView( $keyword );
            
            $skin_dir = $homeDir . "/view/board/list/";
            $font_dir = $homeDir . "/fonts/";
            
            //echo $realDir . '/view/board/list/head.php';
            
            include $realDir . '/view/board/list/head.php';
            include $realDir . '/view/board/list/body.php';
            include $realDir . '/view/board/list/foot.php';
        }
        else{
            // 오류 메시지 출력
            echo "존재하지 않는 테이블입니다.(The table does not exist.)";
        }
        
        #phpinfo();
        
    }
    
    public function view($pageId){
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        
        $boardDB = new BoardDB($connect, $boardName);
        $boardState = $boardDB->isTable();
        $boardFn = new BoardFunction();
        
        $state = $boardDB->isContent($pageId);
        
        $authorErr = '';
        $passwdErr = '';
        $passwdChkErr = '';
        $memoErr = '';
        
        if ( $boardState === true && 
             $state === true ){
        
            $element = $boardDB->view($pageId);
            $commentStack = $boardDB->comment_list($pageId);
            
            #print_r($commentElem);
            
            $title = "보기(View Post) - " . $pageId;
            $skin_dir = $homeDir . "/view/board/view/";
            $font_dir = $homeDir . "/fonts/";
            
            include $realDir . '/view/board/view/head.php';
            include $realDir . '/view/board/view/body.php';
            include $realDir . '/view/board/view/foot.php';
            
        }else if ($boardState === false &&
                  $state === false){
            // 존재하지 않은 테이블
            
        }
        else{
            // 존재하지 않은 컨텐츠
            
        }
        
    }
    
    public function write(){
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        $boardDB = new BoardDB($connect, $boardName);
        $boardFn = new BoardFunction();
        $state = $boardDB->isTable();
        
        if ( $state === true ){
        
            $title = "글쓰기(Write)";
            $skin_dir = $homeDir . "/view/board/write/";
            $font_dir = $homeDir . "/fonts/";
            
            include './view/board/write/head.php';
            include './view/board/write/body.php';
            include './view/board/write/foot.php';
        
        }else{
            
            // 존재하지 않은 테이블
            
        }
        
    }
    
    
    public function write_ok($boardElem){
        
        # 상태
        $state = 0;
        $boardState = 0;
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        $boardDB = new BoardDB($connect, $boardName);
        $boardState = $boardDB->isTable();
        
        $boardFn = new BoardFunction();
        
        // 게시글 원소
        $author = $boardElem->getAuthor();
        $subject = $boardElem->getSubject();
        $passwd = $boardElem->getPasswd();
        $memo = $boardElem->getMemo();
        
        if ( strlen ($author) === 0 )
        {
            $authorErr = '작성자 입력 오류(Author input error)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        if (strlen($subject) === 0 ){
            $subjectErr = '제목 빈칸입니다.(Title is blank)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        if (strlen($memo) === 0 ){
            $memoErr = '내용이 빈칸입니다.(Memo is blank)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        if (strlen($passwd) <= 8 && $passwd !== -1 ){
            $passwdErr = '비밀번호 8자리 이하(8 digits or less)';
            $state = 0;
        }
        else if (strlen($passwd) >= 0 && 
                 $passwd === -1){
            $passwdChkErr = '비밀번호 불일치(Password mismatch)';
            $state = 0;
        }
        else if ($passwd === ''){
            $passwdErr = '비밀번호 미입력(No password)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        #echo $passwd;
        #echo $state;
        
        if ( $state === 0 &&
             $boardState === true ){
            
            $title = "글쓰기(Write)";
            $skin_dir = $homeDir . "/view/board/view/";
            $font_dir = $homeDir . "/fonts/";
            
            include './view/board/write/head.php';
            include './view/board/write/body.php';
            include './view/board/write/foot.php';
            
        }else if ( $state === 1 && 
                   $boardState === true){
                // 글 등록 기능 수행
           $boardDB->insert($boardElem);
           #echo '참';
           
           $url = $homeDir . "/index.php/board/" . $boardName . "/list";
           $message = '성공적으로 등록되었습니다.\\n(Successfully registered)';
           echo "<script>\n";
           echo "alert('$message');";
           echo "location.href='$url';";
           echo "</script>";
           
           
        }
        else{
           
           // 존재하지 않은 테이블
            
        }
        
    }
    
    public function modify($pageId){
        
        # 상태
        $state = 0;
        $boardState = 0;
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        $boardDB = new BoardDB($connect, $boardName);
        $boardState = $boardDB->isTable();
        $state = $boardDB->isContent($pageId);
        
        $boardFn = new BoardFunction();
        
        $title = "글 수정(Modify Post)";
        $skin_dir = $homeDir . "/view/board/modify/";
        $font_dir = $homeDir . "/fonts/";
        
        // 내용 가져오기
        $element = $boardDB->view($pageId);
        $mode = $element->getMode();
        $subject = $element->getSubject();
        $author = $element->getAuthor();
        $memo = $element->getMemo();
        
        if ( $boardState === true && 
             $state === true ){
            
            include './view/board/modify/head.php';
            include './view/board/modify/body.php';
            include './view/board/modify/foot.php';
            
        }else if ($boardState === false && 
                  $state === false){            
            // 존재하지 않은 테이블
            
        }
        else{
            // 컨텐츠 미존재
            
        }
        
    }
    
    public function modify_ok($pageId, $boardElem){
        
        # 상태
        $state = 0;
        $boardState = 0;
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        $boardDB = new BoardDB($connect, $boardName);
        $boardState = $boardDB->isTable();
        $state = $boardDB->isContent($pageId);
        
        $boardFn = new BoardFunction();
        
        $skin_dir = $homeDir . "/view/board/modify/";
        $font_dir = $homeDir . "/fonts/";
        
        // 게시글 원소
        $author = $boardElem->getAuthor();
        $subject = $boardElem->getSubject();
        $passwd = $boardElem->getPasswd();
        $memo = $boardElem->getMemo();
        
        if ( strlen ($author) === 0 )
        {
            $authorErr = '작성자 입력 오류(Author input error)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        if (strlen($subject) === 0 ){
            $subjectErr = '제목 빈칸입니다.(Title is blank)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        if (strlen($memo) === 0 ){
            $memoErr = '내용이 빈칸입니다.(Memo is blank)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        if (strlen($passwd) <= 8 && $passwd !== -1 ){
            $passwdErr = '비밀번호 8자리 이하(8 digits or less)';
            $state = 0;
        }
        else if (strlen($passwd) >= 0 &&
            $passwd === -1){
                $passwdChkErr = '비밀번호 불일치(Password mismatch)';
                $state = 0;
        }
        else if ($passwd === ''){
            $passwdErr = '비밀번호 미입력(No password)';
            $state = 0;
        }
        else if ( !$boardDB->isCheckPasswd($pageId, $passwd)){
            $passwdErr = '비밀번호 불일치(Password mismatch)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        
        #echo $passwd;
        #echo $state;
        
        if ( $state === 0 &&
            $boardState === true ){
                
                $title = "글 수정(Modify Post)";
                
                include './view/board/modify/head.php';
                include './view/board/modify/body.php';
                include './view/board/modify/foot.php';
                
        }else if ( $state === 1 &&
            $boardState === true){
                // 글 수정 기능 수행
                $boardElem->setId($pageId);
                $boardDB->modify($boardElem);
                
                $url = $homeDir . "/index.php/board/" . $boardName . "/list";
                $message = '성공적으로 수정되었습니다.\\n(Successfully modified)';
                echo "<script>\n";
                echo "alert('$message');";
                echo "location.href='$url';";
                echo "</script>";
                
        }
        else{
            
            // 존재하지 않은 테이블
            $url = $homeDir . "/index.php/board/" . $boardName . "/list";
            $message = '존재하지 않는 테이블입니다.\\n(The table does not exist.)';
            echo "<script>\n";
            echo "alert('$message');";
            echo "location.href='$url';";
            echo "</script>";
        }
        
    }
    
    public function remove($pageId){
        
        # 상태
        $state = 0;
        $boardState = 0;
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        $boardDB = new BoardDB($connect, $boardName);
        $boardState = $boardDB->isTable();
        $state = $boardDB->isContent($pageId);
        
        $boardFn = new BoardFunction();
        
        $title = "글 삭제(Remove Post)";
        $skin_dir = $homeDir . "/view/board/remove/";
        $font_dir = $homeDir . "/fonts/";
        
        // 내용 가져오기
        $element = $boardDB->view($pageId);
        $mode = $element->getMode();
        $subject = $element->getSubject();
        $author = $element->getAuthor();
        $memo = $element->getMemo();
        
        if ( $boardState === true &&
            $state === true ){
                
                include './view/board/remove/head.php';
                include './view/board/remove/body.php';
                include './view/board/remove/foot.php';
                
        }else if ($boardState === false &&
            $state === false){
            
            // 존재하지 않은 테이블
            $url = $homeDir . "/index.php/board/" . $boardName . "/list";
            $message = '존재하지 않는 테이블입니다.\\n(The table does not exist.)';
            echo "<script>\n";
            echo "alert('$message');";
            echo "location.href='$url';";
            echo "</script>";
        }
        else{
            
            // 컨텐츠 미존재
            $url = $homeDir . "/index.php/board/" . $boardName . "/list";
            $message = '콘텐츠가 존재하지 않습니다.\\n(The content does not exist)';
            echo "<script>\n";
            echo "alert('$message');";
            echo "location.href='$url';";
            echo "</script>";
            
        }
        
    }
    
    public function remove_ok($pageId, $boardElem){
        
        # 상태
        $state = 0;
        $boardState = 0;
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        $boardDB = new BoardDB($connect, $boardName);
        $boardState = $boardDB->isTable();
        $state = $boardDB->isContent($pageId);
        
        $boardFn = new BoardFunction();
        
        $skin_dir = $homeDir . "/view/board/remove/";
        $font_dir = $homeDir . "/fonts/";
        
        $passwd = $boardElem->getPasswd();
        
        if (strlen($passwd) <= 8 && $passwd != -1 ){
            $passwdErr = '비밀번호 8자리 이하(8 digits or less)';
            $state = 0;
        }
        else if (strlen($passwd) == 0){
            $passwdErr = '비밀번호 미입력(No password)';
            $state = 0;
        }
        else if (strlen($passwd) > 8 &&
            !$boardDB->isCheckPasswd($pageId, $passwd)){
                $passwdErr = '비밀번호 불일치(Password mismatch)';
                $state = 0;
        }
        else{
            $state = 1;
        }
        
        #echo $passwd;
        #echo $state;
        
        if ( $state === 0 &&
            $boardState === true ){
                
                $title = "글 삭제(Remove Post)";
                
                include './view/board/remove/head.php';
                include './view/board/remove/body.php';
                include './view/board/remove/foot.php';
                
        }else if ( $state === 1 &&
            $boardState === true){
                // 글 삭제 기능 수행
                
                $boardElem->setId($pageId);
                $boardDB->remove($boardElem);
                
                $url = $homeDir . "/index.php/board/" . $boardName . "/list";
                $message = '성공적으로 삭제되었습니다.\\n(Successfully deleted)';
                echo "<script>\n";
                echo "alert('$message');";
                echo "location.href='$url';";
                echo "</script>";
                
        }
        else{
            
            // 존재하지 않은 테이블
            
        }
        
    }
    
    public function comment_write_ok($pageId, $commentElem){
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        
        $boardDB = new BoardDB($connect, $boardName);
        $commentStack = $boardDB->comment_list($pageId);
        
        $boardState = $boardDB->isTable();
        $boardFn = new BoardFunction();
        
        $state = $boardDB->isContent($pageId);
        
        // 게시글 원소
        $author = $commentElem->getAuthor();
        $passwd = $commentElem->getPasswd();
        $memo = $commentElem->getMemo();
        
        $authorErr = '';
        $passwdErr = '';
        $passwdChkErr = '';
        $memoErr = '';
        
        if ( strlen ($author) === 0 )
        {
            $authorErr = '작성자 입력 오류(Author input error)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        if (strlen($memo) === 0 ){
            $memoErr = '내용이 빈칸입니다.(Memo is blank)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        #echo strlen($passwd);
        
        if (strlen($passwd) <= 8 && $passwd !== -1 ){
            $passwdErr = '비밀번호 8자리 이하(8 digits or less)';
            $state = 0;
        }
        else if (strlen($passwd) >= 0 &&
            $passwd === -1){
                $passwdChkErr = '비밀번호 불일치(Password mismatch)';
                $state = 0;
        }
        else if ($passwd === ''){
            $passwdErr = '비밀번호 미입력(No password)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        
        #echo $boardState;
        #echo $state;
        
        if ( $boardState == 1 &&
            $state == 1 ){
                
                $boardDB->comment_insert($commentElem);
                
                $url = $homeDir . "/index.php/board/" . $boardName . "/view/" . $pageId;
                $message = '성공적으로 등록되었습니다.\\n(Successfully registered)';
                echo "<script>\n";
                echo "alert('$message');";
                echo "location.href='$url';";
                echo "</script>";
                
                
        }else if ($boardState === false &&
            $state === false){
                // 존재하지 않은 테이블
                
        }else if ($boardState == 1 &&
                  $state == 0 ){
                // 입력 내용 오류 발생
                
                $element = $boardDB->view($pageId);
                
                $title = "보기(View Post) - " . $pageId;
                $skin_dir = $homeDir . "/view/board/view/";
                $font_dir = $homeDir . "/fonts/";
                
                include $realDir . '/view/board/view/head.php';
                include $realDir . '/view/board/view/body.php';
                include $realDir . '/view/board/view/foot.php';
                
        }
        else{
            // 존재하지 않은 컨텐츠
        }
        
    }
    
    public function comment_modify_ok($pageId, $commentElem){
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        
        $boardDB = new BoardDB($connect, $boardName);
        $commentStack = $boardDB->comment_list($pageId);
        
        $boardState = $boardDB->isTable();
        $boardFn = new BoardFunction();
        
        $state = $boardDB->isContent($pageId);
        
        // 게시글 원소
        $author = $commentElem->getAuthor();
        $passwd = $commentElem->getPasswd();
        $memoMsg = $commentElem->getMemo();
        
        $passwdErrMsg = '';
        $memoErrMsg = '';
                
        if (strlen($memoMsg) === 0 ){
            $memoErrMsg = '내용이 빈칸입니다.(Memo is blank)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        #echo strlen($passwd);
        
        if (strlen($passwd) <= 8 && $passwd != -1 ){
            $passwdErrMsg = '비밀번호 8자리 이하(8 digits or less)';
            $state = 0;
        }
        else if (strlen($passwd) == 0){
            $passwdErrMsg = '비밀번호 미입력(No password)';
            $state = 0;
        }
        else if (strlen($passwd) > 8 &&
            !$boardDB->comment_isPassword($commentElem)){
                $passwdErrMsg = '비밀번호 불일치(Password mismatch)';
                $state = 0;
        }
        else{
            $state = 1;
        }
        
        #echo $passwdErrMsg;
        
        #echo $boardState . "/";
        #echo $state;
        
        if ( $boardState == 1 &&
            $state == 1 ){
                
                $boardDB->comment_modify($commentElem);
                
                $url = $homeDir . "/index.php/board/" . $boardName . "/view/" . $pageId;
                $message = '성공적으로 수정되었습니다.\\n(Successfully modified)';
                echo "<script>\n";
                echo "alert('$message');";
                echo "location.href='$url';";
                echo "</script>";
                
        }else if ($boardState === false &&
            $state === false){
                // 존재하지 않은 테이블
                
        }else if ($boardState == 1 &&
            $state == 0 ){
                // 입력 내용 오류 발생
                
                $element = $boardDB->view($pageId);
                
                $title = "보기(View Post) - " . $pageId;
                $skin_dir = $homeDir . "/view/board/view/";
                $font_dir = $homeDir . "/fonts/";
                
                include $realDir . '/view/board/view/head.php';
                include $realDir . '/view/board/view/body.php';
                include $realDir . '/view/board/view/foot.php';
                
        }
        else{
            // 존재하지 않은 컨텐츠
        }
        
    }
    
    public function comment_remove_ok($pageId, $commentElem){
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        
        $boardDB = new BoardDB($connect, $boardName);
        $commentStack = $boardDB->comment_list($pageId);
        
        $boardState = $boardDB->isTable();
        $boardFn = new BoardFunction();
        
        $state = $boardDB->isContent($pageId);
        
        // 게시글 원소
        $author = $commentElem->getAuthor();
        $passwd = $commentElem->getPasswd();
        $memo = $commentElem->getMemo();
        
        $authorErr = '';
        $passwdErr = '';
        $passwdChkErr = '';
        $memoErr = '';
        $passwdErrMsg = '';
        $memoErrMsg = '';
        
        if (strlen($memo) === 0 ){
            $memoErrMsg = '내용이 빈칸입니다.(Memo is blank)';
            $state = 0;
        }
        else{
            $state = 1;
        }
        
        #echo strlen($passwd);
        
        if (strlen($passwd) <= 8 && $passwd != -1 ){
            $passwdErrMsg = '비밀번호 8자리 이하(8 digits or less)';
            $state = 0;
        }
        else if (strlen($passwd) == 0){
            $passwdErrMsg = '비밀번호 미입력(No password)';
            $state = 0;
        }
        else if (strlen($passwd) > 8 &&
            !$boardDB->comment_isPassword($commentElem)){
                $passwdErrMsg = '비밀번호 불일치(Password mismatch)';
                $state = 0;
        }
        else{
            $state = 1;
        }
        
        
        #echo $boardState;
        #echo $state;
        
        if ( $boardState == 1 &&
            $state == 1 ){
                
                $boardDB->comment_remove($commentElem);
                
                $url = $homeDir . "/index.php/board/" . $boardName . "/view/" . $pageId;
                $message = '성공적으로 삭제되었습니다.\\n(Successfully deleted)';
                echo "<script>\n";
                echo "alert('$message');";
                echo "location.href='$url';";
                echo "</script>";
                
        }else if ($boardState === false &&
            $state === false){
                // 존재하지 않은 테이블
                
        }else if ($boardState == 1 &&
            $state == 0 ){
                // 입력 내용 오류 발생
                
                $element = $boardDB->view($pageId);
                
                $title = "보기(View Post) - " . $pageId;
                $skin_dir = $homeDir . "/view/board/view/";
                $font_dir = $homeDir . "/fonts/";
                
                include $realDir . '/view/board/view/head.php';
                include $realDir . '/view/board/view/body.php';
                include $realDir . '/view/board/view/foot.php';
                
        }
        else{
            // 존재하지 않은 컨텐츠
        }
        
    }
    
    
}

?>