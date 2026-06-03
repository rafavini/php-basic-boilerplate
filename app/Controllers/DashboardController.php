<?php

namespace Controllers;

use Core\Auth;
use Core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        Auth::require();
        $this->view('dashboard/index', ['user' => Auth::user()]);
    }
}
