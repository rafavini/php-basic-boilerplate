<?php

namespace Controllers;

use Core\Auth;
use Core\Controller;
use Models\Sample;

class SampleController extends Controller
{
    public function index()
    {
        $users = Sample::all();
        $this->view('sample/index', ['users' => $users]);
    }

    public function form()
    {
        $id   = $_GET['id'] ?? null;
        $user = $id ? Sample::find($id) : null;
        $this->view('sample/form', ['user' => $user]);
    }

    public function save()
    {
        $id   = $_POST['id'] ?? null;
        $data = [
            'name'     => $_POST['name'],
            'email'    => $_POST['email'],
            'password' => $_POST['password'] ?? '',
        ];
        $id ? Sample::update($id, $data) : Sample::create($data);
        $this->redirect('/');
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) Sample::delete($id);
        $this->redirect('/');
    }
}
