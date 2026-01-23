<?php

namespace Controllers;

use Core\Controller;
use Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/php-basic-boilerplate/login');
        }

        $users = User::all();
        $this->view('dashboard/index', [
            'user' => $_SESSION['user'],
            'users' => $users
        ]);
    }
}
