<?php

class BoardDB{
    
    private $connect;
    private $boardName;
    private $paging;
    
    public function __construct($connect, $boardName){
        $this->connect = $connect;
        $this->boardName = $boardName;
        $this->paging = new BoardPaging($this->connect);
        $this->paging->setBoardName($boardName);
    }
    
    public function __destruct(){
        unset($this->connect);
        unset($this->boardName);
        unset($this->paging);
    }
    
    /*
     * 
     * 
     */
    public function isTable(){
        
        $connect = $this->connect;
        $boardName = $this->boardName;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        //1. DB 연결
        $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
                     $mysql_password, $mysql_database);
        
        // Check connection(연결 확인)
        if (mysqli_connect_errno())  {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        $sql = "SHOW TABLES LIKE 'board_" . $boardName . "'";
        #echo $sql;
        
        $result_exist = $mysqlConn->query($sql);
        $exist = ( $result_exist->num_rows > 0 );
        
        $mysqlConn->close();
        
        return $exist;
        
    }
    
    /*
     * 
     * 
     */
    public function isContent($articleId){
        
        $connect = $this->connect;
        $boardName = $this->boardName;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        //1. DB 연결
        $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
            $mysql_password, $mysql_database);
        
        // Check connection(연결 확인)
        if (mysqli_connect_errno())  {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        $sql = sprintf("SELECT * FROM board_%s WHERE id = %s",
                       $boardName, $articleId);
        #echo $sql;
        
        $result_exist = $mysqlConn->query($sql);
        $exist = ( $result_exist->num_rows > 0 );
        
        $mysqlConn->close();
        
        return $exist;
        
    }
    
    /*
     *
     *
     */
    public function isCheckPasswd($articleId, $passwd){
        
        $password = $passwd;                                    // Security 미적용
        $connect = $this->connect;
        $boardName = $this->boardName;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        //1. DB 연결
        $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
            $mysql_password, $mysql_database);
        
        // Check connection(연결 확인)
        if (mysqli_connect_errno())  {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        $sql = sprintf("SELECT * FROM board_%s WHERE id = %s and passwd = %s",
            $boardName, $articleId, $password);
        #echo $sql;
        
        $result_exist = $mysqlConn->query($sql);
        $exist = ( $result_exist->num_rows > 0 );
        
        $mysqlConn->close();
        
        return $exist;
        
    }
    
    // 페이징 구현
    public function listPaging($pageID, $keyword){
        $paging = $this->paging;
        $paging->setKeyword($keyword);
        $paging->operate($pageID);
    }
    
    public function pager(){
        $boardName = $this->boardName;
        $this->paging->pager($boardName);
    }
    
    public function view($pageId){
        
        $element = new BoardModel();
        $connect = $this->connect;
        
        $boardName = $this->boardName;
        
        // PDO 방식 (연결 생성 - Create connection)
        $mysqlConn = new mysqli($connect->getHostname(),
                                $connect->getUsername(),
                                $connect->getPassword(),
                                $connect->getDatabase());
        
        // 연결 확인(Check Connection)
        if ($mysqlConn->connect_error){
            die("Connection failed: " . $mysqlConn->connect_error);
        }
        
        $sql = "set session character_set_connection=utf8;";
        $result = $mysqlConn->query($sql);
        $sql = "set session character_set_results=utf8;";
        $result = $mysqlConn->query($sql);
        $sql = "set session character_set_client=utf8;";
        $result = $mysqlConn->query($sql);
        
        
        
        $sql = sprintf("SELECT * FROM board_%s " .
                       "WHERE id = %s", $boardName, $pageId); // SQL 인젝션 점검
        
        #echo $sql;
        
        $result = $mysqlConn->query($sql);
        
        if ( $result->num_rows > 0){
            
            while ( $row = $result->fetch_assoc() ){
                
                $element->setId( $row['id'] );
                $element->setMemberId( $row['memberId'] );
                $element->setMode( $row['mode'] );
                $element->setAuthor( $row['author'] );
                $element->setPasswd( $row['passwd'] );
                $element->setSubject( $row['subject'] );
                $element->setMemo( $row['memo'] );
                $element->setRegidate( $row['regidate'] );
                $element->setCommentCnt( $row['commentCnt'] );
                $element->setIp( $row['ip'] );
                $element->setCnt( $row['cnt'] );
            }
            
            
        }else{
            // 데이터가 존재하지 않을 때
            
        }
        
        $mysqlConn->close();
        
        return $element;
    }
    
    public function rssView(){
        
        $stack = [];
        $connect = $this->connect;
        
        $boardName = $this->boardName;
        
        // PDO 방식 (연결 생성 - Create connection)
        $mysqlConn = new mysqli($connect->getHostname(),
            $connect->getUsername(),
            $connect->getPassword(),
            $connect->getDatabase());
        
        // 연결 확인(Check Connection)
        if ($mysqlConn->connect_error){
            die("Connection failed: " . $mysqlConn->connect_error);
        }
        
        $sql = "set session character_set_connection=utf8;";
        $result = $mysqlConn->query($sql);
        $sql = "set session character_set_results=utf8;";
        $result = $mysqlConn->query($sql);
        $sql = "set session character_set_client=utf8;";
        $result = $mysqlConn->query($sql);
        
        # SQL 문법(SQL Statement)
        $sql = sprintf("SELECT * FROM board_%s order by id desc",
                        $boardName); // SQL 인젝션 점검
        
        #echo $sql;
        
        $result = $mysqlConn->query($sql);
        
        if ( $result->num_rows > 0){
            
            while ( $row = $result->fetch_assoc() ){
                
                $element = new BoardModel();
                $element->setId( $row['id'] );
                $element->setMemberId( $row['memberId'] );
                $element->setMode( $row['mode'] );
                $element->setAuthor( $row['author'] );
                $element->setPasswd( $row['passwd'] );
                $element->setSubject( $row['subject'] );
                $element->setMemo( $row['memo'] );
                $element->setRegidate( $row['regidate'] );
                $element->setCommentCnt( $row['commentCnt'] );
                $element->setIp( $row['ip'] );
                $element->setCnt( $row['cnt'] );
                
                array_push($stack, $element);
                
            }
            
        }else{
            // 데이터가 존재하지 않을 때
            
        }
        
        $mysqlConn->close();
        
        return $stack;
    }
    
    public function listView($keyword){
        
        $stack = [];
        $connect = $this->connect;
        
        $boardName = $this->boardName;
        $paging = $this->paging;
        
        $s_point = @($paging->getPage() - 1 ) * $paging->getList();
        
        if ( $s_point < 0 ){
            $s_point = 0;
        }
        
        $s_list = $paging->getList();
        
        // PDO 방식 (연결 생성 - Create connection)
        $mysqlConn = new mysqli($connect->getHostname(),
                                $connect->getUsername(),
                                $connect->getPassword(),
                                $connect->getDatabase());
        
        // 연결 확인(Check Connection)
        if ($mysqlConn->connect_error){
            die("Connection failed: " . $mysqlConn->connect_error);
        }
        
        $sql = "set session character_set_connection=utf8;";
        $result = $mysqlConn->query($sql);
        $sql = "set session character_set_results=utf8;";
        $result = $mysqlConn->query($sql);
        $sql = "set session character_set_client=utf8;";
        $result = $mysqlConn->query($sql);
        
        if ( strlen($keyword) === 0 ){
        
            # SQL 문법(SQL Statement)
            $sql = sprintf("SELECT * FROM board_%s order by id desc " .
                "LIMIT %s, %s", $boardName, $s_point, $s_list); // SQL 인젝션 점검
        
        }else{
            
            # SQL 문법(SQL Statement)
            $sql = sprintf("SELECT * FROM board_%s WHERE subject like '%%%s%%' " . 
                           "order by id desc " .
                           "LIMIT %s, %s", $boardName, $keyword, $s_point, $s_list); // SQL 인젝션 점검
        }
        
        # echo $sql;
        
        $result = $mysqlConn->query($sql);
        
        if ( $result->num_rows > 0){
        
            while ( $row = $result->fetch_assoc() ){
                
                $element = new BoardModel();
                $element->setId( $row['id'] );
                $element->setMemberId( $row['memberId'] );
                $element->setMode( $row['mode'] );
                $element->setAuthor( $row['author'] );
                $element->setPasswd( $row['passwd'] );
                $element->setSubject( $row['subject'] );
                $element->setMemo( $row['memo'] );
                $element->setRegidate( $row['regidate'] );
                $element->setCommentCnt( $row['commentCnt'] );
                $element->setIp( $row['ip'] );
                $element->setCnt( $row['cnt'] );
                
                array_push($stack, $element);
                
            }
            
        
        }else{
            // 데이터가 존재하지 않을 때
            
        }
        
        $mysqlConn->close();
        
        return $stack;
    }
    
    public function insert($element){
        
        $connect = $this->connect;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        $boardName = $this->boardName;
        
        if ( strlen($boardName) === 0 ){
            #echo '게시판 명을 입력하세요.';
        }
        else{
        
            //1. DB 연결
            $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
                                $mysql_password, $mysql_database);
            
            // Check connection(연결 확인)
            if (mysqli_connect_errno())  {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            // escape variables for security
            $memberId = mysqli_real_escape_string($mysqlConn, $element->getMemberId());
            $category = mysqli_real_escape_string($mysqlConn, $element->getCategory());
            $mode = mysqli_real_escape_string($mysqlConn, $element->getMode());
            $author = mysqli_real_escape_string($mysqlConn, $element->getAuthor());
            $passwd = mysqli_real_escape_string($mysqlConn, $element->getPasswd());
            $subject = mysqli_real_escape_string($mysqlConn, $element->getSubject());
            $memo = mysqli_real_escape_string($mysqlConn, $element->getMemo());
            $regidate = date('Y-m-d H:i:s', time());
            $commentCnt = 0;
            $ip = $_SERVER["REMOTE_ADDR"];
            $cnt = 0;
            
            $sql= sprintf("INSERT INTO board_%s (memberId, category, mode, " . 
                          "author, passwd, subject, memo, " .
                          "regidate, commentCnt, ip, cnt)" .
                          " VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', " . 
                          "'%s', '%s', '%s', '%s')",
                            $boardName, $memberId, $category, $mode, $author,
                            $passwd, $subject, $memo, $regidate, $commentCnt, $ip, $cnt);
            
            #echo "<br>" . $sql;
            
            if (!mysqli_query($mysqlConn, $sql))  {
                die('Error: ' . mysqli_error($mysqlConn));
            }
            
            # echo "1 record added";
            
            mysqli_close($mysqlConn);
       
        }
        
    }
    
    public function remove($element){
        
        $connect = $this->connect;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        $boardName = $this->boardName;
        
        if ( strlen($boardName) === 0 ){
            #echo '게시판 명을 입력하세요.';
        }
        else{
            
            //1. DB 연결
            $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
                                        $mysql_password, $mysql_database);
            
            // Check connection(연결 확인)
            if (mysqli_connect_errno())  {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            // escape variables for security
            $articleId = $element->getId();
            $memberId = mysqli_real_escape_string($mysqlConn, $element->getMemberId());
            $passwd = mysqli_real_escape_string($mysqlConn, $element->getPasswd());
            
            // 회원기능 지원할 때
            #if ( $memberId != -1 ){
            
                # $sql= sprintf("DELETE FROM board_%s WHERE id = %s and memberId = %s",
            #              $boardName, $articleId, $memberId);
            #}
            #else{
                
            #}
            
             $sql= sprintf("DELETE FROM board_%s WHERE id = %s and passwd = %s",
                           $boardName, $articleId, $passwd);
            
            # echo "<br>" . $sql;
            
            if (!mysqli_query($mysqlConn, $sql))  {
                die('Error: ' . mysqli_error($mysqlConn));
            }
            
            # echo "1 record remove";
            
            mysqli_close($mysqlConn);
            
        }
        
    }
    
    public function modify($element){
        
        $connect = $this->connect;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        $boardName = $this->boardName;
        
        if ( strlen($boardName) === 0 ){
            #echo '게시판 명을 입력하세요.';
        }
        else{
            
            //1. DB 연결
            $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
                $mysql_password, $mysql_database);
            
            // Check connection(연결 확인)
            if (mysqli_connect_errno())  {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            // escape variables for security
            $articleId = $element->getId();
            $memberId = mysqli_real_escape_string($mysqlConn, $element->getMemberId());
            $category = mysqli_real_escape_string($mysqlConn, $element->getCategory());
            $mode = mysqli_real_escape_string($mysqlConn, $element->getMode());
            $author = mysqli_real_escape_string($mysqlConn, $element->getAuthor());
            $subject = mysqli_real_escape_string($mysqlConn, $element->getSubject());
            $memo = mysqli_real_escape_string($mysqlConn, $element->getMemo());
            $passwd = mysqli_real_escape_string($mysqlConn, $element->getPasswd());
            
            if ( $memberId != -1 ){
                
                $sql= sprintf("UPDATE board_%s SET category = '%s', " . 
                              "mode = '%s', author = '%s', " .
                              "subject = '%s', memo = '%s' " .
                              "WHERE id = '%s' and memberId = '%s' and passwd = '%s'",
                    $boardName, $category, $mode,
                    $author, $subject, $memo, $articleId, $memberId, $passwd);
                
            }
            else{
                
                $sql= sprintf("UPDATE board_%s SET category = '%s', " .
                              "mode = '%s', author = '%s'," .
                              "subject = '%s', memo = '%s' " .
                              "WHERE id = '%s' and passwd = '%s'",
                    $boardName, $category, $mode, $author,
                    $subject, $memo, $articleId, $passwd);
                
            }
                
            #echo "<br>" . $sql;
            
            if (!mysqli_query($mysqlConn, $sql))  {
                die('Error: ' . mysqli_error($mysqlConn));
            }
            
            # echo "1 record modified";
            
            mysqli_close($mysqlConn);
            
        }
        
    }
    
    public function comment_list($pageId){
        
        $stack = [];
        $connect = $this->connect;
        
        $boardName = $this->boardName;
        
        // PDO 방식 (연결 생성 - Create connection)
        $mysqlConn = new mysqli($connect->getHostname(),
                                $connect->getUsername(),
                                $connect->getPassword(),
                                $connect->getDatabase());
        
        // 연결 확인(Check Connection)
        if ($mysqlConn->connect_error){
            die("Connection failed: " . $mysqlConn->connect_error);
        }
        
        $sql = "set session character_set_connection=utf8;";
        $result = $mysqlConn->query($sql);
        $sql = "set session character_set_results=utf8;";
        $result = $mysqlConn->query($sql);
        $sql = "set session character_set_client=utf8;";
        $result = $mysqlConn->query($sql);
        
        $articleId = $pageId;
        
        # SQL 문법(SQL Statement)
        $sql = sprintf("SELECT * FROM board_%s_comment WHERE articleId = '%s' " .
                       "order by id desc ",
                        $boardName, $articleId); // SQL 인젝션 점검
        
        #echo $sql;
        
        $result = $mysqlConn->query($sql);
        
        if ( $result->num_rows > 0){
            
            while ( $row = $result->fetch_assoc() ){
                
                $element = new CommentModel();
                $element->setId( $row['id'] );
                $element->setArticleId( $row['articleId'] );
                $element->setMemberId( $row['memberId'] );
                $element->setAuthor( $row['author'] );
                $element->setPasswd( $row['passwd'] );
                $element->setMemo( $row['memo'] );
                $element->setRegidate( $row['regidate'] );
                $element->setIp( $row['ip'] );
                
                array_push($stack, $element);
                
            }
            
            
        }else{
            // 데이터가 존재하지 않을 때
            
        }
        
        $mysqlConn->close();
        
        return $stack;
        
    }
    
    public function comment_insert($element){
        
        $connect = $this->connect;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        $boardName = $this->boardName;
        
        if ( strlen($boardName) === 0 ){
            #echo '게시판 명을 입력하세요.';
        }
        else{
            
            //1. DB 연결
            $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
                $mysql_password, $mysql_database);
            
            // Check connection(연결 확인)
            if (mysqli_connect_errno())  {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            // escape variables for security
            $articleId = mysqli_real_escape_string($mysqlConn, $element->getArticleId());
            $memberId = mysqli_real_escape_string($mysqlConn, $element->getMemberId());
            $author = mysqli_real_escape_string($mysqlConn, $element->getAuthor());
            $passwd = mysqli_real_escape_string($mysqlConn, $element->getPasswd());
            $memo = mysqli_real_escape_string($mysqlConn, $element->getMemo());
            $regidate = date('Y-m-d H:i:s', time());
            $ip = $_SERVER["REMOTE_ADDR"];
            
            $sql= sprintf("INSERT INTO board_%s_comment (articleId, memberId, author, " .
                "passwd, memo, regidate, ip)" .
                " VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                $boardName, $articleId, $memberId, $author, $passwd,
                $memo, $regidate, $ip);
            
            #echo "<br>" . $sql;
            
            if (!mysqli_query($mysqlConn, $sql))  {
                die('Error: ' . mysqli_error($mysqlConn));
            }
            
            # echo "1 record added";
            
            mysqli_close($mysqlConn);
            
        }
        
    }
    
    public function comment_isPassword($element){

        
        $password = $passwd;                                    // Security 미적용
        $connect = $this->connect;
        $boardName = $this->boardName;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        //1. DB 연결
        $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
            $mysql_password, $mysql_database);
        
        // Check connection(연결 확인)
        if (mysqli_connect_errno())  {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
                
        $commentId = mysqli_real_escape_string($mysqlConn, $element->getId());
        $commentPasswd = mysqli_real_escape_string($mysqlConn, $element->getPasswd());
        
        $sql = sprintf("SELECT * FROM board_%s_comment WHERE id = '%s' and passwd = '%s'",
                        $boardName, $commentId, $commentPasswd);
        #echo $sql;
        
        $result_exist = $mysqlConn->query($sql);
        $exist = ( $result_exist->num_rows > 0 );
        
        $mysqlConn->close();
        
        return $exist;
        
    }
    
    public function comment_modify($element){
        
        $connect = $this->connect;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        $boardName = $this->boardName;
        
        if ( strlen($boardName) === 0 ){
            #echo '게시판 명을 입력하세요.';
        }
        else{
            
            //1. DB 연결
            $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
                $mysql_password, $mysql_database);
            
            // Check connection(연결 확인)
            if (mysqli_connect_errno())  {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            // escape variables for security
            $commentId = $element->getId();
            $memo = mysqli_real_escape_string($mysqlConn, $element->getMemo());
            $passwd = mysqli_real_escape_string($mysqlConn, $element->getPasswd());
        
            
            $sql= sprintf("UPDATE board_%s_comment SET " .
                "memo = '%s' " .
                "WHERE id = '%s' and passwd = '%s'",
                $boardName, $memo,
                $commentId, $passwd);
                
            
            #echo "<br>" . $sql;
            
            if (!mysqli_query($mysqlConn, $sql))  {
                die('Error: ' . mysqli_error($mysqlConn));
            }
            
            # echo "1 record modified";
            
            mysqli_close($mysqlConn);
            
        }
        
    }
    
    public function comment_remove($element){
        
        $connect = $this->connect;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        $boardName = $this->boardName;
        
        if ( strlen($boardName) === 0 ){
            #echo '게시판 명을 입력하세요.';
        }
        else{
            
            //1. DB 연결
            $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
                $mysql_password, $mysql_database);
            
            // Check connection(연결 확인)
            if (mysqli_connect_errno())  {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            // escape variables for security
            $articleId = $element->getId();
            $memberId = mysqli_real_escape_string($mysqlConn, $element->getMemberId());
            $passwd = mysqli_real_escape_string($mysqlConn, $element->getPasswd());
            
            // 회원기능 지원할 때
            #if ( $memberId != -1 ){
            
            # $sql= sprintf("DELETE FROM board_%s WHERE id = %s and memberId = %s",
            #              $boardName, $articleId, $memberId);
            #}
            #else{
            
            #}
            
            $sql= sprintf("DELETE FROM board_%s_comment WHERE id = %s and passwd = %s",
                $boardName, $articleId, $passwd);
            
            # echo "<br>" . $sql;
            
            if (!mysqli_query($mysqlConn, $sql))  {
                die('Error: ' . mysqli_error($mysqlConn));
            }
            
            # echo "1 record remove";
            
            mysqli_close($mysqlConn);
            
        }
        
    }
    
}

?>