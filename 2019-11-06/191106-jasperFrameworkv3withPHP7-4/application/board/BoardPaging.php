<?php

class BoardPaging{
    
    private $connect;
    private $boardName;
    private $keyword;
    
    private $num;
    private $page;
    private $list;
    private $block;
    private $pageNum;
    private $blockNum;
    private $nowBlock;
    private $s_page;
    private $e_page;
    
    // Constructor and Destructor(생성자와 소멸자)
    public function __construct( $connect ){
        $this->connect = $connect;
        $this->keyword = null;
    }
    
    public function __destruct(){
        
        # 데이터베이스(Database)
        unset($this->connect);
        unset($this->boardName);
        
        # 페이징 영역(Paging)
        unset($this->num);
        unset($this->page);
        unset($this->list);
        unset($this->block);
        unset($this->pageNum);
        unset($this->blockNum);
        unset($this->nowBlock);
        unset($this->s_page);
        unset($this->e_page);
        
        # 키워드
        unset($this->keyword);
        
    }
    
    // Getter and Setter
    
    public function getBoardName(){
        return $this->boardName;
    }
    
    public function setBoardName($boardName){
        $this->boardName = $boardName;
    }
    
    public function getNum(){
        return $this->num;
    }
    
    public function getPage(){
        return $this->page;
    }
    
    public function getList(){
        return $this->list;
    }
    
    public function getBlock(){
        return $this->block;
    }
    
    public function getPageNum(){
        return $this->pageNum;
    }
    
    public function getBlockNum(){
        return $this->blockNum;
    }
    
    public function getNowBlock(){
        return $this->nowBlock;
    }
    
    public function getS_Page(){
        return $this->s_page;
    }
    
    public function getE_Page(){
        return $this->e_page;
    }
    
    public function setNum($num){
        $this->num = $num;
    }
    
    public function setPage($page){
        $this->page = $page;
    }
    
    public function setList($list){
        $this->list = $list;
    }
    
    public function setBlock($block){
        $this->block = $block;
    }
    
    public function setPageNum($pageNum){
        $this->pageNum = $pageNum;
    }
    
    public function setBlockNum($blockNum){
        $this->blockNum = $blockNum;
    }
    
    public function setNowBlock($nowBlock){
        $this->nowBlock = $nowBlock;
    }
    
    public function setS_Page($s_page){
        $this->s_page = $s_page;
    }
    
    public function setE_Page($e_page){
        $this->e_page = $e_page;
    }
    
    public function getKeyword(){
        return $this->keyword;
    }
    
    public function setKeyword($keyword){
        $this->keyword = $keyword;
    }
    
    // Method
    public function operate($pageId){
        
        $state = false;
        $connect = $this->connect;
        $boardName = $this->getBoardName();
        $keyword = $this->getKeyword();
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        // MySQL 연결단자
        $mysqlConn = null;
        
        if ( strlen($boardName) === 0 ){
            echo '게시판 명을 입력하세요.';
        }else{
            $state = true;
        }
        
        if ( $state === true ){
        
            //1. DB 연결
            $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
                $mysql_password, $mysql_database);
            
            // Check connection(연결 확인)
            if (mysqli_connect_errno())  {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        
            $sql = "set session character_set_connection=$mysql_charset;";
            $result = $mysqlConn->query($sql);
            $sql = "set session character_set_results=$mysql_charset;";
            $result = $mysqlConn->query($sql);
            $sql = "set session character_set_client=$mysql_charset;";
            $result = $mysqlConn->query($sql);
            
            
            # $query = "SELECT id FROM board_$boardName ORDER BY id DESC";
            // SQL Injection - 미점검
            $query = "";
            if ( strlen($keyword) === 0 ){
                $query = sprintf("SELECT id FROM board_%s ORDER BY id DESC",
                                 $boardName);
                // SQL Injection 점검
            }else{
                $query = sprintf("SELECT id FROM board_%s WHERE subject like '%%%s%%' " .
                                 "ORDER BY id DESC",
                    $boardName, $keyword);
                
                // SQL Injection 점검
            }
            
            $result = mysqli_query($mysqlConn, $query) or 
                        die('Query failed: ' . mysqli__error($mysqlConn));
            
            $this->setNum( mysqli_num_rows( $result ) );
            
            $this->setPage( $pageId?$pageId:1 );
            
            $this->setList( 10 );
            $this->setBlock ( 10 );
            
            $this->setPageNum( ceil($this->getNum() / $this->getList()) ); // 총 페이지
            $this->setBlockNum( ceil($this->getPageNum() / $this->getBlock() ) ); // 총 블록
            $this->setNowBlock( @ceil( $pageId / $this->getBlock() ) );
            
            // Block이 0일 때
            if ( $this->getNowBlock() == 0 ){
                $this->setNowBlock( 1 );
            }
            
            $this->setS_page( ( $this->getNowBlock() * $this->getBlock() ) - 2 );
            
            if ( $this->getS_page() <= 1 ) {
                $this->setS_page( 1 );
            }
            
            $this->setE_page( $this->getNowBlock() * $this->getBlock() );
            
            if ($this->getPageNum() <= $this->getE_page()) {
                $this->setE_page( $this->getPageNum() );
            }
            
            // Free resultset
            mysqli_free_result($result);
            
            // Closing connection
            mysqli_close($mysqlConn);
            
        }
        
        
    }
    
    public function message(){
        
        echo "현재 페이지는".$this->getPage()."<br/>";
        echo "현재 블록은".$this->getNowBlock()."<br/>";
        
        echo "현재 블록의 시작 페이지는".$this->getS_page()."<br/>";
        echo "현재 블록의 끝 페이지는".$this->getE_page()."<br/>";
        
        echo "총 페이지는".$this->getPageNum()."<br/>";
        echo "총 블록은".$this->getBlockNum()."<br/>";
    }
    
    public function pager( $boardName ){
        
        $query_string = $_SERVER['QUERY_STRING'];
        
        if ( $query_string !== ''){
            $query_string = "?" . $_SERVER['QUERY_STRING'];
        }
        
        @$s_page = $this->getPage() - 1;
        @$n_page = $this->getPage() + 1;
        $e_page = $this->getPageNum();
        
        echo "\t\t\t<table id=\"pager_font\" style=\"width:100%;\">\n";
        echo "\t\t\t\t<tr>\n";
        
        // 처음, 이전
        echo "\t\t\t\t<td style=\"width:40%;\">\n";
        echo "\t\t\t\t\t\n";
        echo "\t\t\t\t\t<a href=\"1" . $query_string . "\">처음(First)</a>\n";
        
        if ( $s_page != 0 ){
            echo "\t\t\t\t<a href=\"$s_page" . $query_string . "\">이전(Prev)</a>\n";
        }
        
        echo "\t\t\t\n";
        echo "\t\t\t</td>\n";
        
        // 실제 페이지
        echo "\t\t\t<td>\n";
        echo "\t\t\t\t<ul id=\"pager\">\n";
        for ( $p = $this->getNowBlock(); $p <= $this->getE_page(); $p++ ) {
            
            if ( $this->getPage() == $p )
            {
                echo "\t\t\t\t\t<li>";
                echo "<a href=\"$p" . $query_string . "\" class=\"active\">$p</a></li>\n";
            }
            else{
                echo "\t\t\t\t\t<li>";
                echo "<a href=\"$p" . $query_string  . "\">$p</a></li>\n";
            }
        }
        echo "\t\t\t\t</ul>\n";
        echo "\t\t\t\t</td>";
        
        // 다음, 마지막
        echo "\n<td style=\"width:20%\">\n";
        echo "\t\t\t\t\n";
        
        if ( $this->getPage() != $e_page ){
            echo "\t\t\t";
            echo "<a href=\"$n_page" . $query_string . "\">Next(다음)</a>\n";
        }
        echo "\t\t\t";
        echo "<a href=\"$e_page" . $query_string . "\">Last(마지막)</a>\n";
        
        echo "\t\t</td>\n";
        echo "\t\t\t</tr>\n";
        echo "\t\t\t</table>\n";
    }
    
}

?>