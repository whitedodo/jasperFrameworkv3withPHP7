<?php

/*
 * Subject: Downloader - Jasper Framework v3
 * Created Date: 2019-11-06
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */

class BoardDownloader{
    
    private $filename;
    private $realname;
    private $homeDir;
    private $realDir;
    
    public function __construct( $filename, $realname ){
        $this->filename = $filename;
        $this->realname = $realname;
    }
    
    public function __destruct(){
        unset($this->filename);
        unset($this->realname);
    }
    
    
    public function run(){
        
        $this->download();
        
    }
    
    private function download(){
        
        $filename = $this->getFilename();
        $realname = $this->getRealname();
        
        //echo $realname;
        /*
         *  ex)   $filename = "image1.png";
         *        $file =  $_SERVER['DOCUMENT_ROOT'] . "/images/" .$filename;
         */
        
        if (is_file($realname)) {
            
            if (@preg_match("MSIE", $_SERVER['HTTP_USER_AGENT'])) {
                
                header("Content-type: application/octet-stream");
                header("Content-Length: ".filesize("$realname"));
                header("Content-Disposition: attachment; filename=$filename"); // 다운로드되는 파일명 (실제 파일명과 별개로 지정 가능)
                header("Content-Transfer-Encoding: binary");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Pragma: public");
                header("Expires: 0");
                
            }
            else {
                header("Content-type: file/unknown");
                header("Content-Length: ".filesize("$realname"));
                header("Content-Disposition: attachment; filename=$filename"); // 다운로드되는 파일명 (실제 파일명과 별개로 지정 가능)
                header("Content-Description: PHP 7 Generated Data");
                header("Pragma: no-cache");
                header("Expires: 0");
            }
            
            $fp = fopen($realname, "rb");
            fpassthru($fp);
            fclose($fp);
        }
        else {
            
            echo "해당 파일이 없습니다.";
            
        } // end of if
        
    }
    
    public function getHomeDir(){
        return $this->homeDir;
    }
    
    public function getRealDir(){
        return $this->realDir;
    }
    
    public function setHomeDir($homeDir){
        $this->homeDir = $homeDir;
    }
    
    public function setRealDir($realDir){
        $this->realDir = $realDir;
    }
    
    public function setDirectories($homeDir, $realDir){
        $this->homeDir = $homeDir;
        $this->realDir = $realDir;
    }
    
    public function getFilename(){
        return $this->filename;
    }
    
    public function getRealname(){
        return $this->realname;
    }
    
    public function setFilename($filename){
        $this->filename = $filename;
    }
    
    public function setRealname($realname){
        $this->realname = $realname;
    }
    
}

?>
