<?php

namespace Controllers;

use Core\Controller;
use Models\User;
use Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $this->checkAdmin();
        $users = User::all();
        $this->view('users/index', ['users' => $users]);
    }

    public function form()
    {
        $this->checkAdmin();
        $id = $_GET['id'] ?? null;
        $user = null;
        
        if ($id) {
            $user = User::find($id);
            if (!$user) {
                $this->redirect('/php-basic-boilerplate/users');
            }
        }

        $roles = Role::all();
        $this->view('users/form', ['user' => $user, 'roles' => $roles]);
    }

    public function store()
    {
        $this->checkAdmin();
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'role_id' => $_POST['role_id']
        ];

        User::create($data);
        $this->redirect('/php-basic-boilerplate/users');
    }

    public function update()
    {
        $this->checkAdmin();
        $id = $_POST['id'];
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'role_id' => $_POST['role_id']
        ];

        User::update($id, $data);
        $this->redirect('/php-basic-boilerplate/users');
    }

    public function delete()
    {
        $this->checkAdmin();
        $id = $_GET['id'];
        User::delete($id);
        $this->redirect('/php-basic-boilerplate/users');
    }

    private function checkAdmin()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/php-basic-boilerplate/login');
        }

        if ($_SESSION['user']['role'] !== 'admin') {
            die("Unauthorized. Only Admins can manage users.");
        }
    }
}
