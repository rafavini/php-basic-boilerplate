<?php

namespace Controllers;

use Core\Controller;
use Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/php-vanilla/dashboard');
        }
        $this->view('auth/login');
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role_name']
            ];
            $this->redirect('/php-vanilla/dashboard');
        } else {
            $this->view('auth/login', ['error' => 'Credenciais invlidas']);
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/php-vanilla/login');
    }
}
