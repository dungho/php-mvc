<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * User controller
 *

 */
class UserController extends \Core\Controller
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();     
    }
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('User/index', ['users' => $this->userModel->getAll()]);
    }

    public function createAction()
    {
        View::renderTemplate('User/create');
    }

    public function storeAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $this->userModel->create($_POST)) {
            header('location: http://localhost:8585/users', true, 303);
        } else {
            die(TASK_NOT_CREATED);
        }
    }
}
