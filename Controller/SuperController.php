<?php

namespace App\Controller;

class SuperController
{
    protected function render($chemin, array $tab = [])
    {
        extract($tab);
        ob_start();
        include '../Views/' . $chemin . '.php';

        $vue = ob_get_clean();

        include '../Views/super_view/layout.php';
    }

    protected function renderAjax($chemin, array $tab = [])
    {
        extract($tab);
        ob_start();
        include '../Views/' . $chemin . '.php';

        $vue = ob_get_clean();

        echo $vue;
    }

    protected function redirectToRoute($route) {
        // TODO
    }

    protected function addFlashMessage($msg)
    {
        if (empty($_SESSION['flashMessages'])) {
            $_SESSION['flashMessages'] = [];
        }
        $_SESSION['flashMessages'][] = $msg;
    }

    protected function getCurrentUser()
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : false;
    }
}
