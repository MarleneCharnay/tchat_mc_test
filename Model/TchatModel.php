<?php

namespace App\Model;

class TchatModel extends SuperModel
{
    public function tchatList()
    {
        $query = 'SELECT t.*, u.pseudo FROM tchat t JOIN user u ON t.id_user = u.id_user ORDER BY t.id_tchat DESC LIMIT 10';
        $stmt = $this->mypdo->query($query);
        $messages = $stmt->fetchAll(\PDO::FETCH_CLASS, '\\App\\Entity\\TchatEntity');

        return array_reverse($messages);
    }

    public function tchatInsert($tchatinsert)
    {
        $query = 'INSERT INTO tchat (content, id_user, created_at) VALUES (:content, :id_user, :created_at)';
        $stmt = $this->mypdo->prepare($query);
        $stmt->bindValue(':content', $tchatinsert->getContent(), \PDO::PARAM_STR);
        $stmt->bindValue(':id_user', $tchatinsert->getIdUser(), \PDO::PARAM_INT);
        $stmt->bindValue(':created_at', $tchatinsert->getCreatedAt(), \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
}

?>
