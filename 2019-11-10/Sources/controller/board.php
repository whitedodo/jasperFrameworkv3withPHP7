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
        $this->boardName = null;
        $this->keyword = null;
    }
    
    public function __destruct(){
        unset($this->conn);
        unset($this->realDir);
        unset($this->homeDir);
        unset($this->boardName);
        unset($this->keyword);
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
    
    public function boardList($title, $pageId){
        
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
    
    public function noticeList($title, $pageId){
        
        $myConnect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        $boardDB = new BoardDB($myConnect, $boardName);
        $boardFn = new BoardFunction();
        
        $state = $boardDB->isTable();
        
        if ( $state ){

            $stack = $boardDB->noticeView();
            
            $skin_dir = $homeDir . "/view/board/notice/";
            $font_dir = $homeDir . "/fonts/";
            
            //echo $realDir . '/view/board/list/head.php';
            
            include $realDir . '/view/board/notice/head.php';
            include $realDir . '/view/board/notice/body.php';
            include $realDir . '/view/board/notice/foot.php';
        }
        else{
            // 오류 메시지 출력
            echo "존재하지 않는 테이블입니다.(The table does not exist.)";
        }
        
    }
    
    public function view($pageId){
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        
        $ipAddr = $_SERVER["REMOTE_ADDR"];
        $usrDate = date('Y-m-d H:i:s', time());
        
        
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
            $fileStack = $boardDB->fileViewAll($boardName, $pageId);
            
            $boardCountLogic = new BoardCountLogic($ipAddr, $usrDate, $element);
            $boardCountLogic = $boardCountLogic->countLogic();
            
            if ( $boardCountLogic == true ){
                $boardDB->articleChangeCnt($pageId);
            }
            
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
    
    public function downloader($fileId){
        
        $connect = $this->conn;
        $boardName = $this->boardName;
        
        #$filename = "License.txt";
        #$realname = "C:/Apache24/htdocs/MyHomepage/space/24743273231822840890";
        
        
        $boardDB = new BoardDB($connect, $boardName);
        $element = $boardDB->fileView($fileId);
        
        #print_r($element);
        
        foreach ( $element as $val ){
            
            $filename = $val->getFileName();
            $realname = $val->getUploadDir() . $val->getRealName();
            
            #print_r($val);
            $boardDB->insertFileLog($val);
            
            $boardDownloader = new BoardDownloader($filename, $realname, $element);
            $boardDownloader->run();
            
        }
        
    }
    
    
    public function boardProtected($pageId){
        
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
        
        $title = "글 보호글(Protected Post)";
        $skin_dir = $homeDir . "/view/board/protected/";
        $font_dir = $homeDir . "/fonts/";
        
        // 내용 가져오기
        $element = $boardDB->view($pageId);
        $mode = $element->getMode();
        $subject = $element->getSubject();
        $author = $element->getAuthor();
        $memo = $element->getMemo();
        
        if ( $boardState === true &&
            $state === true ){
                
                include './view/board/protected/head.php';
                include './view/board/protected/body.php';
                include './view/board/protected/foot.php';
                
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
    
    
    public function protected_read_ok($pageId, $boardElem, $mode){
        
        # 세션
        @session_cache_expire(60);          // 1시간 뒤에 파괴(동작 안할 수도 있음.)
        session_start();                    // 세션 시작
        
        # 상태
        $state = 0;
        $boardState = 0;
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $commentElem = new CommentModel();
        $commentElem->setArticleId($pageId);
        
        $boardName = $this->boardName;
        $boardDB = new BoardDB($connect, $boardName);
        $boardState = $boardDB->isTable();
        $state = $boardDB->isContent($pageId);
        
        $boardFn = new BoardFunction();
        
        $skin_dir = $homeDir . "/view/board/protected/";
        $font_dir = $homeDir . "/fonts/";
        
        $passwd = $boardElem->getPasswd();
        
        #echo $passwd;
        
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
                
                $title = "글 보호글(Protected Post)";
                
                include './view/board/protected/head.php';
                include './view/board/protected/body.php';
                include './view/board/protected/foot.php';
                
        }else if ( $state === 1 &&
                   $boardState === true){
               // 글 일반 기능으로 수행
                       
               if ( isset($_SESSION['protectType']) &&
                    isset($_SESSION['protectResult'])){
                    $_SESSION['protectResult'] = "success_" . $pageId;
               }        
               
               if (  strcmp ( $_SESSION['protectType'] , 'read') === 0 &&
                   strcmp($_SESSION['protectResult'], "success_" . $pageId) === 0){
                   //echo "참";
                   header("location:" . "../view/" . $pageId);
               }
               else if (  strcmp ( $_SESSION['protectType'] , 'modify') === 0 &&
                       strcmp($_SESSION['protectResult'], "success_" . $pageId) === 0){
                   header("location:" . "../modify/" . $pageId);
               }
                
        }
        else{
            
            // 존재하지 않은 테이블
            
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
        $category = $element->getCategory();
        $memberId = $element->getMemberId();
        $mode = $element->getMode();
        $subject = $element->getSubject();
        $author = $element->getAuthor();
        $memo = $element->getMemo();
        
        if ( $boardState === true && 
            $state === true ){
            
            $fileStack = $boardDB->fileViewAll($boardName, $pageId);
            
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
        
        #echo $passwd;
        
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
        #echo $boardState;
        
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
                
                if ($_POST['IsfileRemove'] === 'yes'){
                    $this->upload_removeAll($boardName, $pageId);      // 주석처리
                }
                
                $this->modify_upload_ok($boardName, $pageId);
                
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
    
    private function modify_upload_ok($boardName, $pageId){
        
        $index = 0;
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        
        $boardDB = new BoardDB($connect, $boardName);
        
        $uploadBase = '/space/';
        
        $allowed_ext = array('jpg', 'jpeg', 'pdf', 'png', 'gif', 'hwp', 'doc', 'docx', 
                             'zip', 'xls', 'xlsx', 'tar.gz', 'ppt', 'pptx', 'txt');
        
        $boardFn = new BoardFunction();
        $boardFn->make_if_no_folder($realDir . $uploadBase);
        
        foreach ($_FILES['myfile']['name'] as $f => $name ){
            
            $name = $_FILES['myfile']['name'][$f];
            $uploadName = explode('.', $name);
            
            $realName = time() * time() . $f;
            $realExt = $uploadName[1];
            $fileType = $_FILES['myfile']['type'][$f];
            $fileSize = $_FILES['myfile']['size'][$f];
            $uploadDir = $realDir . $uploadBase;
            $uploadFile = $realDir . $uploadBase . $realName;
            
            #echo $_FILES['myfile']['tmp_name'][$f];
            
            if (!in_array($realExt, $allowed_ext)){
                #echo "허용되지 않는 확장자입니다.(Extension not allowed)";
            }else{
                
                if ( move_uploaded_file($_FILES['myfile']['tmp_name'][$f], $uploadFile) ){
                
                    #echo 'success';
                    
                    $element = new BoardFileModel();
                    $element->setArticleId($pageId);
                    $element->setFileName($name);
                    $element->setFileExt($realExt);
                    $element->setFileType($fileType);
                    $element->setFileSize($fileSize);
                    $element->setUploadDir($uploadDir);
                    $element->setRealName($realName);
                    
                    $boardDB->insertFile($boardName, $element);
                    
                }else{
                    echo 'error';
                }
            
            }
            
            $index++;
            
        } // end of foreach
        
    }
    
    private function upload_removeAll($boardName, $pageId){
        
        $connect = $this->conn;
        
        $boardDB = new BoardDB($connect, $boardName);
        $element = $boardDB->fileViewAll($boardName, $pageId);
        $boardDB->removeFileAll($boardName, $pageId);
        
        foreach ( $element as $val ){
            $realFile = $val->getUploadDir() . $val->getRealName();
            $fileId = $val->getId();
            #echo $realFile;
            unlink($realFile);
            $boardDB->removeFileLogAll($fileId);
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
        
        $commentElem = new CommentModel();
        $commentElem->setArticleId($pageId);
        
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
                $commentElem->setArticleId($pageId);
                $boardDB->remove($boardElem);
                $boardDB->comment_remove($commentElem);
                $this->upload_removeAll($boardName, $pageId);
                
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
    
    public function op_remove($pageId){
        
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
        
        $title = "운영자 - 글 삭제(Operator - Remove Post)";
        $skin_dir = $homeDir . "/view/board/op_remove/";
        $font_dir = $homeDir . "/fonts/";
        
        // 내용 가져오기
        $element = $boardDB->view($pageId);
        $mode = $element->getMode();
        $subject = $element->getSubject();
        $author = $element->getAuthor();
        $memo = $element->getMemo();
        
        if ( $boardState === true &&
            $state === true ){
                
                include './view/board/op_remove/head.php';
                include './view/board/op_remove/body.php';
                include './view/board/op_remove/foot.php';
                
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
    
    public function op_remove_ok($pageId){
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        
        $boardDB = new BoardDB($connect, $boardName);
        $state = $boardDB->isContent($pageId);
        
        $boardElem = $boardDB->view($pageId);
        $commentElem = new CommentModel();
        $commentElem->setArticleId($pageId);
        
        
        $boardDB->remove($boardElem);
        $boardDB->comment_remove($commentElem);
        $this->upload_removeAll($boardName, $pageId);
        
        
        $url = $homeDir . "/index.php/board/" . $boardName . "/list";
        $message = '성공적으로 삭제되었습니다.\\n(Successfully deleted)';
        echo "<script>\n";
        echo "alert('$message');";
        echo "location.href='$url';";
        echo "</script>";
        
    }
    
    
    public function comment_write_ok($pageId, $commentElem){
        
        $connect = $this->conn;
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $boardName = $this->boardName;
        
        $boardDB = new BoardDB($connect, $boardName);
        $ipAddr = $_SERVER["REMOTE_ADDR"];
        $usrDate = date('Y-m-d H:i:s', time());
        
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
                $boardDB->commentChangeCnt($pageId, 'increase');
                
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
                $commentStack = $boardDB->comment_list($pageId);
                $boardCountLogic = new BoardCountLogic($ipAddr, $usrDate, $element);
                
                if ( $boardCountLogic->countLogic() ){
                    $boardDB->articleChangeCnt($pageId);
                }
                
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
        $ipAddr = $_SERVER["REMOTE_ADDR"];
        $usrDate = date('Y-m-d H:i:s', time());
        
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
                $commentStack = $boardDB->comment_list($pageId);
                $boardCountLogic = new BoardCountLogic($ipAddr, $usrDate, $element);
                
                if ( $boardCountLogic->countLogic() ){
                    $boardDB->articleChangeCnt($pageId);
                }
                
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
        $ipAddr = $_SERVER["REMOTE_ADDR"];
        $usrDate = date('Y-m-d H:i:s', time());
        
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
                
                $commentElem->setArticleId($pageId);
                
                $boardDB->comment_remove($commentElem);
                $boardDB->commentChangeCnt($pageId, 'decrease');
                
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
                $commentStack = $boardDB->comment_list($pageId);
                $boardCountLogic = new BoardCountLogic($ipAddr, $usrDate, $element);
                
                if ( $boardCountLogic->countLogic() ){
                    $boardDB->articleChangeCnt($pageId);
                }
                
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