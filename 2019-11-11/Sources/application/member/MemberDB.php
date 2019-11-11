<?php

/*
 * File: BoardDB.php
 * Subject: 게시판 DB
 * Created Date: 2019-10-31
 * Description:
 * 2019-11-08 / Jasper / insert()에 $element-> 암호화, XSS Clean 적용
 * 2019-11-08 / Jasper / 암호화 (AES256 적용)
 */

class MemberDB{
    
    private $connect;
    
    public function __construct($connect){
        $this->connect = $connect;
    }
    
    public function __destruct(){
        unset($this->connect);
    }
    
    public function getEmailDecodeAccount($memberElem){
        
        $aes256 = new AES256();
        $email = $memberElem->getEmail();
        
        $xss = new Xss();
        
        $element = new MemberBaseModel();
        $connect = $this->connect;
        
        
        // PDO 방식 (연결 생성 - Create connection)
        $mysqlConn = new mysqli($connect->getHostname(),
            $connect->getUsername(),
            $connect->getPassword(),
            $connect->getDatabase(),
            $connect->getPort());
        
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
        
        // escape variables for security
        $email = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($email));
        
        $sql = sprintf("SELECT * FROM member_jasper " .
            "WHERE email = '%s'", $email); // SQL 인젝션 점검
        
        #echo $sql;
        
        $result = $mysqlConn->query($sql);
        
        if ( $result->num_rows > 0){
            
            while ( $row = $result->fetch_assoc() ){
                
                $element->setId($row['id']);
                $element->setEmail( $aes256->decode( $row['email'] ));
                $element->setPasswd($row['passwd']);
                $element->setName($row['name']);
                $element->setNickname($row['nickname']);
                $element->setLevel($row['level']);
                $element->setSex($row['sex']);
                $element->setBirthdate($row['birthdate']);
                $element->setRegidate($row['regidate']);
                $element->setIp($row['ip']);
                
            }
            
            
        }else{
            // 데이터가 존재하지 않을 때
            
        }
        
        $mysqlConn->close();
        
        return $element;
        
    }
    
    public function getEmailAccount($memberElem){
        
        $aes256 = new AES256();
        $email = $aes256->encode($memberElem->getEmail());
        
        $xss = new Xss();
        
        $element = new MemberBaseModel();
        $connect = $this->connect;
        
        
        // PDO 방식 (연결 생성 - Create connection)
        $mysqlConn = new mysqli($connect->getHostname(),
            $connect->getUsername(),
            $connect->getPassword(),
            $connect->getDatabase(),
            $connect->getPort());
        
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
        
        // escape variables for security
        $email = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($email));
        
        $sql = sprintf("SELECT * FROM member_jasper " .
                       "WHERE email = '%s'", $email); // SQL 인젝션 점검
        
        #echo $sql;
        
        $result = $mysqlConn->query($sql);
        
        if ( $result->num_rows > 0){
            
            while ( $row = $result->fetch_assoc() ){
                
                $element->setId($row['id']);
                $element->setEmail($row['email']);
                $element->setPasswd($row['passwd']);
                $element->setName($row['name']);
                $element->setNickname($row['nickname']);
                $element->setLevel($row['level']);
                $element->setSex($row['sex']);
                $element->setBirthdate($row['birthdate']);
                $element->setRegidate($row['regidate']);
                $element->setIp($row['ip']);
                
            }
            
            
        }else{
            // 데이터가 존재하지 않을 때
            
        }
        
        $mysqlConn->close();
        
        return $element;
        
    }
    
    public function isEmail($memberElem){
        
        #echo $password;
        $aes256 = new AES256();
        $email = $aes256->encode($memberElem->getEmail());
        $xss = new Xss();
        
        # $password = $passwd;                                    // Security 미적용
        $connect = $this->connect;
        
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
        
        // escape variables for security
        $email = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($email));
        
        $sql = sprintf("SELECT * FROM member_jasper WHERE email = '%s'",
                        $email);
        #echo $sql;
        
        $result_exist = $mysqlConn->query($sql);
        $exist = ( $result_exist->num_rows > 0 );
        
        $mysqlConn->close();
        
        if ($exist === true ){
            return false;
        }
        else{
            return true;
        }
        
    }
    
    public function isAccount($memberElem){
        
        #echo $password;
        $aes256 = new AES256();
        $xss = new Xss();
        
        
        $tmpEmail = $memberElem->getEmail();
        $tmpPasswd = $memberElem->getPasswd();
        
        #echo "비" . $tmpPasswd;
        
        $email = $aes256->encode($tmpEmail);
        $passwd = $aes256->encode($tmpPasswd);
        
        
        $xss = new Xss();
        
        # $password = $passwd;                                    // Security 미적용
        $connect = $this->connect;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        //1. DB 연결
        $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
                                    $mysql_password, $mysql_database, $mysql_port);
        
        // Check connection(연결 확인)
        if (mysqli_connect_errno())  {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        // escape variables for security
        $email = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($email));
        $passwd = mysqli_real_escape_string($mysqlConn, $passwd);
        
        $sql = sprintf("SELECT * FROM member_jasper WHERE email = '%s' and passwd = '%s'",
                       $email, $passwd);
        
        #echo $sql;
        
        $result_exist = $mysqlConn->query($sql);
        $exist = ( $result_exist->num_rows > 0 );
        
        $mysqlConn->close();
        
        #echo "햐" . $exist;
        
        return $exist;
        
    }
    
    public function insert($element){
        
        $aes256 = new AES256();
        $xss = new Xss();
        
        $tmpEmail = $element->getEmail();
        $tmpPasswd = $element->getPasswd();
        
        $email = $aes256->encode($tmpEmail);
        $passwd = $aes256->encode($tmpPasswd);
        
        #echo $tmpEmail . "/" . $email . "/" . $aes256->decode($email) . "<br>";
        #echo $tmpPasswd . "/" . $passwd . "/" . $aes256->decode($passwd) . "<br>";
        
        $connect = $this->connect;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
        //1. DB 연결
        $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
                                    $mysql_password, $mysql_database, $mysql_port);
        
        // Check connection(연결 확인)
        if (mysqli_connect_errno())  {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        // escape variables for security
        $email = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($email));
        $passwd = mysqli_real_escape_string($mysqlConn, $passwd);
        $name = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($element->getName()));
        $nickname = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($element->getNickname()));
        $level = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($element->getLevel()));
        $sex = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($element->getSex()));
        $birthdate = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($element->getBirthdate()));
        $regidate = date('Y-m-d H:i:s', time());
        $ip = $_SERVER["REMOTE_ADDR"];
        
        $sql= sprintf("INSERT INTO member_jasper (email, passwd, name, nickname, " .
            "level, sex, birthdate, regidate, ip)" .
            " VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', " .
            "'%s', '%s')",
            $email, $passwd, $name, $nickname,
            $level, $sex, $birthdate, $regidate, $ip);
        
        #echo "<br>" . $sql;
        
        if (!mysqli_query($mysqlConn, $sql))  {
            die('Error: ' . mysqli_error($mysqlConn));
        }
        
        # echo "1 record added";
        
        mysqli_close($mysqlConn);
            
    }
    
    public function updateBaseMember($element){
        
        
        $aes256 = new AES256();
        $email = $aes256->encode($element->getEmail());         // AES256 Security 적용
        $passwd = $aes256->encode($element->getPasswd());       // AES256 Security 적용
        $xss = new Xss();
        
        $connect = $this->connect;
        
        $mysql_hostname = $connect->getHostname();
        $mysql_username = $connect->getUsername();
        $mysql_password = $connect->getPassword();
        $mysql_database = $connect->getDatabase();
        $mysql_port = $connect->getPort();
        $mysql_charset = $connect->getCharset();
        
    
        //1. DB 연결
        $mysqlConn = mysqli_connect($mysql_hostname, $mysql_username,
            $mysql_password, $mysql_database, $mysql_port);
        
        // Check connection(연결 확인)
        if (mysqli_connect_errno())  {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        // escape variables for security
        $email = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($email));
        $passwd = mysqli_real_escape_string($mysqlConn, $passwd);
        $name = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($element->getName()));
        $nickname = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($element->getNickname()));
        $level = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($element->getLevel()));
        $sex = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($element->getSex()));
        $birthdate = mysqli_real_escape_string($mysqlConn, $xss->xss_clean($element->getBirthdate()));
        
        
        $sql= sprintf("UPDATE member_jasper SET passwd = '%s', " .
                      "name = '%s', nickname = '%s', " .
                      "sex = '%s', birthdate = '%s' " .
                      "WHERE email = '%s'",
                      $passwd, $name, $nickname,
                      $sex, $birthdate, $email);
        
        #echo "<br>" . $sql;
        
        if (!mysqli_query($mysqlConn, $sql))  {
            die('Error: ' . mysqli_error($mysqlConn));
        }
        
        # echo "1 record modified";
        
        mysqli_close($mysqlConn);
        
    }
    
    
}

?>