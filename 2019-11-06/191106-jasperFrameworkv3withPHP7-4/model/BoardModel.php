<?php

/*
 * Subject: PHP 7 - 게시물
 * Created Date: 2019-10-28
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */

class BoardModel{
    
    private $id;                // 번호
    private $memberId;          // 회원ID
    private $category;          // 카테고리(분류)
    private $mode;              // 모드(공개글, 보호글)
    private $author;            // 작성자
    private $passwd;            // 비밀번호
    private $subject;           // 제목
    private $memo;              // 메모
    private $regidate;          // 등록일자
    private $commentCnt;        // 댓글갯수
    private $ip;                // Ip
    private $cnt;               // 조회
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return mixed
     */
    public function getMemberId()
    {
        return $this->memberId;
    }
    
    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * @return mixed
     */
    public function getMode()
    {
        return $this->mode;
    }
    
    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }
    
    /**
     * @return mixed
     */
    public function getPasswd()
    {
        return $this->passwd;
    }
    
    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * @return mixed
     */
    public function getMemo()
    {
        return $this->memo;
    }
    
    /**
     * @return mixed
     */
    public function getRegidate()
    {
        return $this->regidate;
    }
    
    /**
     * @return mixed
     */
    public function getCommentCnt()
    {
        return $this->commentCnt;
    }
    
    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }
    
    /**
     * @return mixed
     */
    public function getCnt()
    {
        return $this->cnt;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @param mixed $memberId
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
    }
    
    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
    
    /**
     * @param mixed $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }
    
    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    
    /**
     * @param mixed $passwd
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }
    
    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    
    /**
     * @param mixed $memo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    }
    
    /**
     * @param mixed $regidate
     */
    public function setRegidate($regidate)
    {
        $this->regidate = $regidate;
    }
    
    /**
     * @param mixed $commentCnt
     */
    public function setCommentCnt($commentCnt)
    {
        $this->commentCnt = $commentCnt;
    }
    
    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }
    
    /**
     * @param mixed $cnt
     */
    public function setCnt($cnt)
    {
        $this->cnt = $cnt;
    }
    
}

?>