<?php

namespace Controllers;

use Core\Controller;
use Models\Role;
use Models\User;

class UserController extends Controller
{
    public function index()
    {
        $this->view('users/index', ['users' => User::all()]);
    }

    public function form()
    {
        $id          = $_GET['id'] ?? null;
        $user        = $id ? User::find($id) : null;
        $userRoleIds = $id ? User::rolesOf((int)$id) : [];
        $roles       = Role::all();
        $this->view('users/form', compact('user', 'roles', 'userRoleIds'));
    }

    public function save()
    {
        $id   = $_POST['id'] ?? null;
        $data = [
            'name'     => $_POST['name'],
            'email'    => $_POST['email'],
            'password' => $_POST['password'] ?? '',
            'role_ids' => $_POST['role_ids'] ?? [],
        ];

        $id ? User::update((int)$id, $data) : User::create($data);
        $this->redirect('/users');
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) User::delete((int)$id);
        $this->redirect('/users');
    }
}
