<?php

class Member{
    
    private $conn;
    private $realDir;
    private $homeDir;
    
    public function __construct($conn, $realDir, $homeDir){
        $this->conn = $conn;
        $this->realDir = $realDir;
        $this->homeDir = $homeDir;
    }
    
    public function __destruct(){
        unset($this->conn);
        unset($this->realDir);
        unset($this->homeDir);
    }
    
    public function login(){
        
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        ### 제목
        $title = "Dodo's Login";
        
        #echo $title;
        
        ### 스킨 경로(Skin Directories)
        $skin_dir = $homeDir . "/view/member/login/";
        $font_dir = $homeDir . "/fonts/";
        
        //echo $realDir . '/view/board/list/head.php';
        
        include $realDir . '/view/member/login/head.php';
        include $realDir . '/view/member/login/body.php';
        include $realDir . '/view/member/login/foot.php';
        
    }
    
    public function login_ok($memberElem){
        
        $connect = $this->conn;
        
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        ### 제목
        $title = "Dodo's Login";
        
        $memberDB = new MemberDB($connect);
        $isAccount = $memberDB->isAccount($memberElem);
        
        #echo $memberElem->getPasswd();
        
        ### 스킨 경로(Skin Directories)
        $skin_dir = $homeDir . "/view/member/login/";
        $font_dir = $homeDir . "/fonts/";
        
        if ( !$isAccount ){
            // 로그인 실패 시(If login fails)
            
            #echo $title;
            //echo $realDir . '/view/board/list/head.php';
            $url = $homeDir . "/index.php/member/login";
            $message = '계정정보가 일치하지 않습니다.\n(Account information does not match.)';
            echo "<script>\n";
            echo "alert('$message');";
            echo "location.href='$url';";
            echo "</script>";
            
            
        }else{
            
            session_start();
            
            $tmpElem = $memberDB->getEmailAccount($memberElem);
            
            # 세션 로그인
            $_SESSION["email"] = $tmpElem->getEmail();
            $_SESSION["login_time"] = date('Y-m-d');
            $_SESSION["level"] = $tmpElem->getLevel();
            
            header("location:" . "login");
        }
        
    }
    
    
    public function openapi_login_ok($memberElem){
        
        $connect = $this->conn;
        
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        ### 제목
        $title = "Dodo's Login";
        
        $memberDB = new MemberDB($connect);
        
        #print_r($memberElem);
        
        $isAccount = $memberDB->isAccount($memberElem);
        
        #echo $memberElem->getPasswd();
        
        ### 스킨 경로(Skin Directories)
        $skin_dir = $homeDir . "/view/member/login/";
        $font_dir = $homeDir . "/fonts/";
        
        if ( !$isAccount ){
            // 로그인 실패 시(If login fails)
            echo "failover";
        }else{
            echo "success";
        }
        
    }
    
    public function logout(){
        
    }
    
    public function join(){
        
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        ### 제목
        $title = "Dodo's Member join - Page";
        
        #echo $title;
        
        ### 스킨 경로(Skin Directories)
        $skin_dir = $homeDir . "/view/member/join/";
        $font_dir = $homeDir . "/fonts/";
        
        //echo $realDir . '/view/board/list/head.php';
        
        include $realDir . '/view/member/join/head.php';
        include $realDir . '/view/member/join/body.php';
        include $realDir . '/view/member/join/foot.php';
        
    }
    
    public function join_ok($memberElem){
        
        #echo "참";
        
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        $myConnect = $this->conn;
        
        $state = 0;
        $memberDB = new MemberDB($myConnect);
        $jasperFN = new JasperFunction();
        
        $isUsrDate = $jasperFN->isPregMatchDate($memberElem->getBirthdate());
        $isUsrEmail = $jasperFN->isPregMatchEmail($memberElem->getEmail());
        $isUsrExistEmail = $memberDB->isEmail($memberElem);
        
        ### 제목
        $title = "Dodo's Member join - Page";
        
        // 이메일 오류
        if ($memberElem->getEmail() === '' ){
            $emailErr = '이메일 주소를 입력하세요.(Please enter an email address.)';
            $email = $memberElem->getEmail();
            $state--;
        }else if ( !$isUsrEmail ){
            $emailErr = '이메일 형식을 맞추세요.(Customize your email format.)';
            $email = $memberElem->getEmail();
            $state--;
        }else if ( !$isUsrExistEmail ){
            $emailErr = '이메일이 중복됩니다.(Email is duplicate.)';
            $email = $memberElem->getEmail();
            $state--;
        }
        else{
            $email = $memberElem->getEmail();
            $state++;
        }
        
        // 비밀번호 오류
        if ($_POST["passwd1"] === '' || 
            $_POST["passwd2"] === ''){
            $passwdErr = '비밀번호를 입력하세요.(Please enter a password.)';
            $state--;
        }
        else if ($memberElem->getPasswd() === -1)
        {
            $passwdErr = '비밀번호 불일치(Password mismatch)';
            $state--;
        }
        else if ( strlen($memberElem->getPasswd()) <= 8){
            $passwdErr = '비밀번호 8자리 이상(8-digit password or more)';
            $state--;
        }else{
            $passwdErr = '';
            $state++;
        }
        
        // 이름 오류
        if (strlen($memberElem->getName()) === 0 ){
            $nameErr = '이름을 입력하세요.(Please enter your name.)';
            $state--;
        }else{
            $name = $memberElem->getName();
            $state++;
        }
        
        // 닉네임 오류
        if (strlen($memberElem->getNickname()) === 0 ){
            $nicknameErr = '닉네임을 입력하세요.(Please enter a nickname.)';
            $state--;
            $nickname = $memberElem->getNickname();
        }else{
            
            $nickname = $memberElem->getNickname();
            $state++;
        }
        
        // 생년일자 입력
        if ( !$isUsrDate ){
            $birthdateErr = '생년월일을 입력하세요.(Please enter your date of birth)';
            $birthdate = $memberElem->getBirthdate();
            #echo "참";
            $state--;
        }else if (strlen( $memberElem->getBirthdate() ) === 0 ) {
            $birthdateErr = '생년월일을 입력하세요.(Please enter your date of birth)';
            $birthdate = $memberElem->getBirthdate();
            #echo "거짓";
            $state--;
        }else{
            $birthdate = $memberElem->getBirthdate();
            $state++;
        }
        
        #echo $title;
        #echo $state;
        
        // 등록 가능한 상태
        if ( $state == 5 ){
            
            #echo $memberElem->getEmail();
            
            $memberElem->setLevel(1);
            $memberDB->insert($memberElem);
            
            $url = $homeDir . "/index.php/member/login";
            $message = '성공적으로 등록되었습니다.\\n(Successfully registered)';
            echo "<script>\n";
            echo "alert('$message');";
            echo "location.href='$url';";
            echo "</script>";
        }
        // 등록 불가능한 상태
        else{
            
            ### 스킨 경로(Skin Directories)
            $skin_dir = $homeDir . "/view/member/join/";
            $font_dir = $homeDir . "/fonts/";
            
            //echo $realDir . '/view/board/list/head.php';
            
            include $realDir . '/view/member/join/head.php';
            include $realDir . '/view/member/join/body.php';
            include $realDir . '/view/member/join/foot.php';
        }
        
    }
    
}

?>