<?php

namespace Controllers;

use Core\Auth;
use Core\Controller;
use Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            $this->redirect('/dashboard');
        }
        $this->view('auth/login');
    }

    public function login()
    {
        $email    = $_POST['email']    ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::findByEmailWithPermissions($email);

        if ($user && password_verify($password, $user['password'])) {
            // Salva na sessão: dados + roles + permissions
            Auth::login([
                'id'          => $user['id'],
                'name'        => $user['name'],
                'email'       => $user['email'],
                'roles'       => $user['roles'],        // ['admin']
                'permissions' => $user['permissions'],  // ['user.create','user.read',...]
            ]);
            $this->redirect('/dashboard');
        }

        $this->view('auth/login', ['error' => 'E-mail ou senha inválidos.']);
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('/login');
    }
}
