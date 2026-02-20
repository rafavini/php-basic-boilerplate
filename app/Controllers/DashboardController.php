<?php

namespace Controllers;

use Core\Controller;
use Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }

        $limit = 5; // Itens por página
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        
        $totalUsers = User::count();
        $totalPages = ceil($totalUsers / $limit);
        
        $users = User::paginate($limit, $offset);

        $this->view('dashboard/index', [
            'user' => $_SESSION['user'],
            'users' => $users,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }
}
