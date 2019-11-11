<?php

/*
 * Subject: PHP 7 - 댓글 모델
 * Created Date: 2019-10-28
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */

class CommentModel{
    
    private $id;
    private $articleId;
    private $memberId;
    private $author;
    private $passwd;
    private $memo;
    private $regidate;
    private $ip;
    
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
    public function getArticleId()
    {
        return $this->articleId;
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
    public function getIp()
    {
        return $this->ip;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @param mixed $boardId
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }
    
    /**
     * @param mixed $memberId
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
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
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }
    
}

?>