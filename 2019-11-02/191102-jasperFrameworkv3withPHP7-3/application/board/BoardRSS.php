<?php
/*
 File: rss_paper.php
 Author: Jaspers
 Created by 2019-11-01
 Goal: 
 Description:
 2018-07-13 / Jasper / Rss_paper
 */

class BoardRSS{
    
    private $nowDate;
    private $boardName;
    private $boardUrl;
    
    private $connect;
    private $rssInfo;
    
    public function __construct($boardName, $boardUrl, $connect){
        $this->nowDate = date("D, d M Y H:i:s T"); // 일자
        $this->boardName = $boardName;
        $this->boardUrl = $boardUrl;
        $this->connect = $connect;
    }
    
    public function __destruct(){
        
        # RSS 기초정보
        unset($this->nowDate);
        unset($this->boardName);
        unset($this->boardUrl);
        
        # 데이터베이스 기초정보
        unset($this->connect);
    }
    
    public function show(){
        
        header("Content-Type: application/rss+xml");
        header("Content-Type: text/xml");
        
        $this->head();
        $this->body();
    }
    
    private function head(){
        
        // RSS 기초정보
        $boardName = $this->boardName;
        $boardURL = $this->boardUrl;
        $nowDate = $this->nowDate;
        
        $rssInfo = new RssInfo();
        
        $url = "http://" . $_SERVER["HTTP_HOST"] . $boardURL;
        $rssInfo->setTitle("Jasper RSS with " . $boardName );
        $rssInfo->setLink( $url . $boardName . "/rss" );
        $rssInfo->setDescription( "RSS Feeder with Board" );
        $rssInfo->setPubDate( $nowDate );
        
        $this->rssInfo = $rssInfo;
        
    }
    
    private function body(){
        
        // 기초정보
        $boardName = $this->boardName;
        $boardURL = $this->boardUrl;
        $connect = $this->connect;
        $url = "http://" . $_SERVER["HTTP_HOST"] . $boardURL;
        $rssInfo = $this->rssInfo;
        
        $board = new BoardDB($connect, $boardName);
        
        $itemList = $board->rssView();
        
        // 1. Bodies(바디) - XML(RSS)
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        echo "\t\t<rss version=\"2.0\">\n";
        echo "\t\t\t<channel>\n";
        echo "\t\t\t\t<title>";
        echo $rssInfo->getTitle();
        echo "</title>\n";
        echo "\t\t\t\t<link>";
        echo $rssInfo->getLink();
        echo "</link>\n";
        echo "\t\t\t\t<description>";
        echo $rssInfo->getDescription();
        echo "</description>\n";
        echo "\t\t\t\t<pubDate>";
        echo $rssInfo->getPubDate();
        echo "</pubDate>\n\n";
        
        // Item - 아이템 게시글        
        $index = 0;
        
        foreach ( $itemList as $item ){
            
            if ( $index != 0 ){
                echo "\t\t\t\t";
                echo "<item>\n";
                echo "\t\t\t\t\t";
                echo "<author>";
                echo $item->getAuthor();
                echo "</author>\n";
                echo "\t\t\t\t\t";
                echo "<category>";
                echo $item->getCategory();
                echo "</category>\n";
                echo "\t\t\t\t\t";
                echo "<title>";
                echo $item->getSubject();
                echo "</title>\n";
                echo "\t\t\t\t\t";
                echo "<link>";
                echo $url . "";
                echo $boardName . "/view/";
                echo $item->getId();
                echo "</link>\n";
                echo "\t\t\t\t\t";
                echo "<guid>";
                echo $url . "";
                echo $boardName . "/view/";
                echo $item->getId();
                echo "</guid>\n";
                echo "\t\t\t\t\t";
                echo "<pubDate>";
                echo $item->getRegidate();
                echo "</pubDate>\n";
                echo "\t\t\t\t\t";
                echo "<description><![CDATA[";
                echo $item->getMemo();
                echo "]]></description>\n";
                echo "\t\t\t\t";
                echo "</item>\n";
            }
            else{
                $index++;
            }
        }
        echo "</channel>\n";
        echo "</rss>\n";
        
    }
    
}


?>