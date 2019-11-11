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
            
            //echo $realDir . '/view/board/list/head.php';
        
        include $realDir . '/view/subpage/index/head.php';
        include $realDir . '/view/subpage/index/body.php';
        include $realDir . '/view/subpage/index/foot.php';
        
        
    }
    
    public function about(){
        
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        ### 제목
        $title = "Dodo's about";
        
        #echo $title;
        
        ### 스킨 경로(Skin Directories)
        $skin_dir = $homeDir . "/view/subpage/about/";
        $font_dir = $homeDir . "/fonts/";
        
        //echo $realDir . '/view/board/list/head.php';
        
        include $realDir . '/view/subpage/about/head.php';
        include $realDir . '/view/subpage/about/body.php';
        include $realDir . '/view/subpage/about/foot.php';
        
    }
    
    public function history(){
        
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        ### 제목
        $title = "Dodo's history";
        
        #echo $title;
        
        ### 스킨 경로(Skin Directories)
        $skin_dir = $homeDir . "/view/subpage/history/";
        $font_dir = $homeDir . "/fonts/";
        
        //echo $realDir . '/view/board/list/head.php';
        
        include $realDir . '/view/subpage/history/head.php';
        include $realDir . '/view/subpage/history/body.php';
        include $realDir . '/view/subpage/history/foot.php';
        
        
    }
    
    public function latestArticle(){
        
        $realDir = $this->realDir;
        $homeDir = $this->homeDir;
        
        ### 제목
        $title = "Dodo's latest";
        
        #echo $title;
        
        ### 스킨 경로(Skin Directories)
        $skin_dir = $homeDir . "/view/subpage/latestArticle/";
        $font_dir = $homeDir . "/fonts/";
        
        //echo $realDir . '/view/board/list/head.php';
        
        include $realDir . '/view/subpage/latestArticle/head.php';
        include $realDir . '/view/subpage/latestArticle/body.php';
        include $realDir . '/view/subpage/latestArticle/foot.php';
        
    }

}

?>