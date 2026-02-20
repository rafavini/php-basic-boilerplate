<?php

namespace Controllers;

use Core\Controller;
use Models\Sample;

class SampleController extends Controller
{
    /**
     * List all users
     */
    public function index()
    {
        $users = Sample::all();
        $this->view('sample/index', ['users' => $users]);
    }

    /**
     * Show form for Create or Edit
     */
    public function form()
    {
        $id = $_GET['id'] ?? null;
        $user = $id ? Sample::find($id) : null;
        
        $this->view('sample/form', ['user' => $user]);
    }

    /**
     * Save data (Create or Update)
     */
    public function save()
    {
        $id = $_POST['id'] ?? null;
        $data = [
            'name'     => $_POST['name'],
            'email'    => $_POST['email'],
            'password' => $_POST['password'] ?? ''
        ];

        if ($id) {
            Sample::update($id, $data);
        } else {
            Sample::create($data);
        }

        $this->redirect('/');
    }

    /**
     * Delete data
     */
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            Sample::delete($id);
        }
        $this->redirect('/');
    }
}
