<?php

namespace App\Model;

use http\Exception\InvalidArgumentException;

class UserModel extends SuperModel
{
    public function getWithCredentials($pseudo, $psw)
    {
        $query = 'SELECT * FROM user WHERE pseudo = :pseudo';
        $stmt = $this->mypdo->prepare($query);
        $stmt->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (password_verify($psw, $user['psw'])) {
            return $user;
        }

        return false;
    }

    public function userInsert($pseudo, $psw)
    {
        if (!$this->checkFormatPseudo($pseudo)) {
            throw new InvalidArgumentException("Le pseudo '$pseudo' ne respecte pas les critères définis.");
        } elseif (!$this->checkFormatPsw($psw)) {
            throw new InvalidArgumentException("Le mot de passe ne respecte pas les critères définis.");
        }

        $hashedPsw = password_hash($psw, PASSWORD_BCRYPT);

        $query = 'INSERT INTO user (pseudo, psw) VALUES (:pseudo, :psw)';
        $stmt = $this->mypdo->prepare($query);
        $stmt->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
        $stmt->bindValue(':psw', $hashedPsw, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }

    public function pseudoAlreadyExists($pseudo)
    {
        $query = 'SELECT * FROM user WHERE pseudo = :pseudo';
        $stmt = $this->mypdo->prepare($query);
        $stmt->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return !empty($user);
    }

    public function connectedUpdate($id, $isConnected)
    {
        $user = $this->getUserbyId($id);
        if ($isConnected) {
            $query = 'UPDATE `user` SET connected = 1 WHERE id_user = ' . $id;
        } else {
            $query = 'UPDATE `user` SET connected = 0 WHERE id_user = ' . $id;
        }
        $this->mypdo->query($query);

        return $user;
    }

    public function allConnected()
    {
        $queryActifs = "SELECT * FROM `user` WHERE connected = 1 ORDER BY pseudo";
        $stmtActifs = $this->mypdo->prepare($queryActifs);
        $stmtActifs->execute();
        $usersActifs = $stmtActifs->fetchAll(\PDO::FETCH_ASSOC);

        $users = [
            'actifs'   => [],
//            'inactifs' => [],
        ];

        foreach ($usersActifs as $usersActif) {
            $users['actifs'][] = $usersActif;
        }

        return $users;
    }

    public function getUserbyId($id)
    {
        $query = 'SELECT * FROM user WHERE id_user = ' . $id;
        $stmt = $this->mypdo->query($query);

        $theuser = $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\App\\Entity\\UserEntity');
        $theuser = $stmt->fetch(\PDO::FETCH_CLASS);

        return $theuser;
    }

    public function checkFormatPseudo($pseudo)
    {
        if (
            $pseudo === strip_tags($pseudo) && mb_strlen($pseudo) >= 3
        ) {
            return true;
        }

        return false;
    }

    public function checkFormatPsw($psw)
    {
        if (mb_strlen($psw) >= 5) {
            return true;
        }

        return false;
    }
}
