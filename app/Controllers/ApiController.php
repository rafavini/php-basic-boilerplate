<?php

namespace Controllers;

use Core\Controller;
use Models\User;

class ApiController extends Controller
{
    public function getUsers()
    {
        if (!isset($_SESSION['user'])) {
            $this->json(['error' => 'Unauthorized'], 401);
        }

        $users = User::all();
        $this->json($users);
    }
}
