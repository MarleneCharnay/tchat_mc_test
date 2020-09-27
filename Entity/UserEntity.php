<?php

namespace App\Entity;

class UserEntity
{
    public $id_user;

    public $pseudo;

    public $psw;

    public $connected;

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
        return $this;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function setPsw($psw)
    {
        $this->psw = password_hash($psw, PASSWORD_BCRYPT);
        return $this;
    }

    public function getConnected()
    {
        return $this->connected;
    }

    public function setConnected($connected)
    {
        $this->connected = $connected;
    }

}
