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
        
        $limit = 2; // Itens por página
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        
        $totalUsers = User::count();
        $totalPages = ceil($totalUsers / $limit);
        
        $users = User::paginate($limit, $offset);
        
        $this->view('users/index', [
            'users' => $users,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function form()
    {
        $this->checkAdmin();
        $id = $_GET['id'] ?? null;
        $user = null;
        
        if ($id) {
            $user = User::find($id);
            if (!$user) {
                $this->redirect('/users');
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
        $this->redirect('/users');
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
        $this->redirect('/users');
    }

    public function delete()
    {
        $this->checkAdmin();
        $id = $_GET['id'];
        User::delete($id);
        $this->redirect('/users');
    }

    private function checkAdmin()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }

        if ($_SESSION['user']['role'] !== 'admin') {
            die("Unauthorized. Only Admins can manage users.");
        }
    }
}
