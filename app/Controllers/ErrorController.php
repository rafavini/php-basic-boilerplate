<?php

namespace Controllers;

use Core\Controller;

class ErrorController extends Controller
{
    public function forbidden()
    {
        http_response_code(403);
        $this->view('errors/403');
    }
}
