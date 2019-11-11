<?php

/*
 * Subject: PHP 7 - BoardFunction
 * File: BoardFunction.php
 * Created Date: 2019-10-28
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 * 2019-11-06 / Jasper / make_if_no_folder($folder) 폴더 권한 777로 변경
 *
 */

class BoardFunction{
    
    // 양식(Mode)
    public function printMode($mode){
        
        echo "\t\t\t<select name=\"mode\">\n";
        
        if ( !empty($mode) ){
            $index = $this->convertTochooseMode($mode);
            echo "\t\t\t\t<option value=\"" . $this->chooseMode($index) . "\">";
            echo $this->titleMode($index);
            echo "</option>";
            
            echo "\n";
        }
        
        for ($index = 1; $index <= $this->sizeMode(); $index++){
            echo "\t\t\t\t<option value=\"" . $this->chooseMode($index) . "\">";
            echo $this->titleMode($index);
            echo "</option>";
            
            echo "\n";
        }
        
        echo "\t\t\t</select>";
    }
    
    public function chooseMode($index){
        
        switch ($index){
            
            case 1:
                return "general";
                
            case 2:
                return "protected";
        }
    }
    
    public function titleMode($index){
        switch ($index){
            
            case 1:
                return "일반(General)";
                
            case 2:
                return "보호(Protected)";
        }
        
    }
    
    public function sizeMode(){
        return 2;
    }
    
    public function convertTochooseMode($keyword){
        
        $id = -1;
        for ( $index = 0; $index <= $this->sizeMode(); $index++){
            
            if ( strcmp( $this->chooseMode($index), $keyword) == 0 )
            {
                $id = $index;
                break;
            }
        }
        
        return $id;
    }
    
    public function make_if_no_folder($folder){
        
        if(!is_dir($folder)){
            
            mkdir($folder, 0777);       // 리눅스, 윈도우 공통(폴더권한 777이상으로 해야함.)
            
            
        }
    }
}

?>