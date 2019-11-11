<?php
/*
 Subject: JasperFramework Version 2
 FileName: JasperFunction.php
 Created Date: 2019-08-31
 Author: Dodo (rabbit.white@daum.net)
 Description:
 
 */

class JasperFunction{
    
    // 한글 지원
    public function convertToUTF8($strTxt)
    {
        if(iconv("utf-8", "utf-8", $strTxt) == $strTxt){
            return $strTxt;
        }
        else
        {
            return iconv("euc-kr", "utf-8", $strTxt );
        }
    }
    
    // 수행시간 측정
    public function getExecutionTime() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
    
    // 날짜 일짜 정규식 체크
    public function isPregMatchDate($date){
        
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date))
        {
            return true;
        }else{
            return false;
        }
        
    }
    
    // 이메일 정규식 체크
    public function isPregMatchEmail($email){
        
        $check_email = preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email);
        
        return $check_email;
    }
    
}

?>