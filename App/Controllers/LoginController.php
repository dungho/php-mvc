<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * User controller
 *

 */
class LoginController extends \Core\Controller
{
    public function createAction()
    {
        View::renderTemplate('Login/create');
    }

    public function storeAction()
    {
        session_start();
        if ( !isset($_POST['username'], $_POST['password']) ) {
            // Could not get the data that should have been sent.
            exit('Please fill both the username and password fields!');
        }
        else {
            $userModel = new User();
            $user = $userModel->getByEmail($_POST['username']);
            if (!empty($user)) {
                if (password_verify($_POST['password'], $user->password)) {
                    session_regenerate_id();
                    $_SESSION['logged'] = TRUE;
                    $_SESSION['name'] = $_POST['username'];
                    $_SESSION['id'] = $user->id;
                    header('Location: http://localhost:8585/login/success', true, 200);
                    die;
                }
                else {
                    header('Location: http://localhost:8585/login', true, 422);
                }
            }
        }
    }

    public function successAction()
    {
        View::renderTemplate('Login/success');
    }
}