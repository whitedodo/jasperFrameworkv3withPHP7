<?php

/*
 * Subject: BoardCountLogic
 * Created Date: 2019-11-03
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */

class BoardCountLogic{
    
    private $ipAddr;
    private $usrDate;
    private $element;
    
    public function __construct($ipAddr, $usrDate, $element){

        $this->ipAddr = $ipAddr;
        $this->usrDate = $usrDate;
        $this->element = $element;
        
    }
    
    public function __destruct(){
        unset($this->ipAddr);
        unset($this->usrDate);
        unset($this->element);
    }
    
    public function getIpAddr(){
        return $this->ipAddr;
    }
    
    public function getUsrDate(){
        return $this->usrDate;
    }
    
    public function getElement(){
        return $this->element;
    }
    
    public function setIpAddr($ipAddr){
        $this->ipAddr = $ipAddr;
    }
    
    public function setUsrDate($usrDate){
        $this->usrDate = $usrDate;
    }
    
    public function setElement($element){
        $this->element = $element;
    }
    
    /*
     * Count Logic
     * Author: Dodo (rabbit.white at daum dot net)
     */
    public function countLogic(){
        
        $state = 0;
        
        $newCountIP = $this->getIpAddr();
        $newUsrDate = $this->getUsrDate();
        $element = $this->getElement();
        
        
        ### 등록 준비(게시글 자기 자신 여부)
        if ( $this->isNewCheckIP($element, $newCountIP) ){
            ## 등록 준비
            $state = 1;
        }else{
            $state = 0;
        }
        #echo $state;
        
        ### 등록일자 일치여부
        if ($this->isNewCheckDate($element, $newUsrDate)){
            ## 등록 준비
           # echo "참";
            $state = 1;
        }else{
            $state = 0;
        }
        #echo $state;
        
        ### 세션 기능
        if ($this->isUsrSession($newCountIP, $newUsrDate)){
            $state = 1;
        }else{
            $state = 0;
        }
        
        #echo $state;
        
        ### 등록
        if ( $state === 1 ){
            return true;
            
        }
        else{
            return false;
        }
        
    }
    
    private function isNewCheckDate($element, $newUsrDate){
        
        $tempDate = $element->getRegidate();
        $currentDate = date("Y-m-d", strtotime($tempDate));
        
        $tempDate = $newUsrDate;
        $newDate = date("Y-m-d", strtotime($tempDate));
        
        #echo $currentDate . "/" . $newDate;
        
        if ( strcmp($currentDate, $newDate) === 0  ){
            return true;
        }else{
            return false;
        }
        
    }
    
    private function isNewCheckIP($element, $newCountIP){
       
        #echo $element->getIp();
        #echo $newCountIP;
        
        ### 동일한 IP일 때
        if ( strcmp($element->getIp(), $newCountIP ) === 0 ){
            ## 등록하지 않음.
            return false;
        }
        else{
            return true;
        } // end of if
        
    }
    
    private function isUsrSession($newCountIP, $newUsrDate){
        
        # 세션
        @session_cache_expire(60);          // 1시간 뒤에 파괴(동작 안할 수도 있음.)
        session_start();                    // 세션 시작
        
       # echo "<br>*";
       # echo $_REQUEST["countIP"] . "/" . $_REQUEST["currentOnDate"];
       # echo "/하하:" . isset($_REQUEST["countIP"]);
        
        // 세션으로 확인
        if ( !isset($_SESSION["countIP"]) && 
            !isset($_SESSION["currentOnDate"])){
            // 세션이 존재하지 않을 때
            
            #echo '참';
                
            # 세션 등록
            $_SESSION['countIP'] = $_SERVER["REMOTE_ADDR"];
            $_SESSION['currentOnDate'] = date('Y-m-d');
            
            return true;
             
        }else{
            
            #echo '거짓';
            
            return false;
        }
        
    }
    
}

?>