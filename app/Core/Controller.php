<?php

namespace Core;

class Controller
{
    protected function view($name, $data = [])
    {
        extract($data);
        $viewFile = __DIR__ . "/../Views/" . $name . ".php";
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            die("View $name not found.");
        }
    }

    protected function json($data, $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    protected function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }
}
