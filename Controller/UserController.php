<?php

namespace App\Controller;

use App\Model\UserModel;

class UserController extends SuperController
{
    function login()
    {
        $userModel = new UserModel();

        $tab = [
            'errors' => [],
        ];

        if ($_POST && $_POST['type-action'] && in_array($_POST['type-action'], ['connexion', 'inscription'])) {
            $typeAction = $_POST['type-action'];

            if ($_POST['pseudo'] !== '' && $_POST['psw'] !== '') {
                $pseudo = $_POST['pseudo'];
                $psw = $_POST['psw'];

                switch ($typeAction) {
                    case "connexion":
                        if (empty($tab['errors'])) {
                            $user = $userModel->getWithCredentials($pseudo, $psw);

                            if (!empty($user)) {
                                $_SESSION['user'] = $user;
                                $userModel->connectedUpdate($_SESSION['user']['id_user'], true);

                                header('Location: /index.php');
                                die();
                            } else {
                                $tab['errors']['connexion'] = 'Identifiant ou mot de passe incorrect';;
                            }
                        }
                        break;
                    case "inscription":
                        if (empty($pseudo)) {
                            $tab['errors']['pseudo'] = 'Pseudo obligatoire';
                        } elseif (!$userModel->checkFormatPseudo($pseudo)) {
                            $tab['errors']['pseudo'] = 'Format de pseudo incorrect (au moins 3 caractères)';
                        }

                        if (empty($psw)) {
                            $tab['errors']['psw'] = 'Mot de passe obligatoire';
                        } elseif (!$userModel->checkFormatPsw($psw)) {
                            $tab['errors']['psw'] = 'Format de mot de passe incorrect (au moins 5 caractères)';
                        }

                        if (empty($tab['errors'])) {
                            if ($userModel->pseudoAlreadyExists($pseudo)) {
                                $tab['errors']['pseudoExists'] = "Le pseudo '$pseudo' est déjà utilisé";
                            } else {
                                $userModel->userInsert($pseudo, $psw);

                                $user = $userModel->getWithCredentials($pseudo, $psw);

                                if (!empty($user)) {
                                    $_SESSION['user'] = $user;
                                    $userModel->connectedUpdate($user['id_user'], true);
                                    header('Location: /index.php');
                                    die();
                                } else {
                                    $tab['errors'][] = "Erreur inattendue";
                                }
                            }
                        }
                        break;
                }
            } else {
                $tab['errors']['connexion'] = 'Un ou plusieurs champs sont vides';
            }
        }
        $this->render('user_view/login', $tab);
    }

    function logout()
    {
        if (isset($_SESSION['user'])) {
            $userModel = new UserModel();
            $userModel->connectedUpdate($_SESSION['user']['id_user'], false);
        }

        unset($_SESSION['user']);

        if (empty($_SESSION['user'])) {
            $this->addFlashMessage('Vous êtes déconnecté');
        }

        header('Location: /index.php');
    }

}

?>
