<?php

class SubPage{
    
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
    
    public function index(){
        
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        ### 제목
        $title = "Dodo's Homepage";
        
        #echo $title;
        
        ### 스킨 경로(Skin Directories)
        $skin_dir = $homeDir . "/view/subpage/index/";
        $font_dir = $homeDir . "/fonts/";
        
        include $realDir . '/view/subpage/index/head.php';
        include $realDir . '/view/subpage/index/body.php';
        include $realDir . '/view/subpage/index/foot.php';
        
    }

}

?>