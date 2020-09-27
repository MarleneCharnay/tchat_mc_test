<?php

namespace App\Entity;

class TchatEntity
{
    public $id_tchat;

    public $content;

    public $id_user;

    public $created_at;

    public function __construct()
    {
        if (empty($this->created_at)) {
            $this->created_at = date('Y-m-d H:i:s');
        }
    }

    public function getIdTchat()
    {
        return $this->id_tchat;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $content = trim($content);
        $content = strip_tags($content);

        $this->content = $content;
        return $this;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

}
