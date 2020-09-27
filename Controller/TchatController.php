<?php

namespace App\Controller;

use App\Entity\TchatEntity;
use App\Model\TchatModel;
use App\Model\UserModel;

class TchatController extends SuperController
{
    public function listMessage()
    {
        if (isset($_SESSION['user'])) {
            $tchatList = new TchatModel();
            $messages = $tchatList->tchatList();

            $tab = ['messages' => $messages];

            $this->render('tchat_view/accueil', $tab);
        } else {
            $this->render('user_view/login');
        }
    }

    public function addMessage()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ../index.php');
            die();
        }

        if (!empty($_POST) && !empty($_POST['content'])) {
            $tchatinsert = new TchatEntity();
            $tchatinsert
                ->setIdUser($_SESSION['user']['id_user'])
                ->setContent($_POST['content']);

            $tchatInsert = new TchatModel();
            $tchatInsert->tchatInsert($tchatinsert);
            die();
        }

        $this->listMessage();
        $this->render('tchat_view/accueil');
    }

    public function ajaxMessages()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ../index.php');
            die();
        }

        $tchatList = new TchatModel();
        $messages = $tchatList->tchatList();

        $tab = ['messages' => $messages];

        $this->renderAjax('ajax_view/thetchat', $tab);
    }

    public function ajaxUsersList()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ../index.php');
            die();
        }

        $userModel = new UserModel();
        $users = $userModel->allConnected();

        $tab = [
            'users' => $users,
        ];

        $this->renderAjax('ajax_view/whoishere', $tab);
    }
}
