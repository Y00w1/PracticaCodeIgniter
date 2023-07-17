<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class Register extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('templates/layout')
        .view('users/register', $data)
        .view('templates/footer');
    }

    public function store()
    {
        helper(['form']);

        if (! $this->request->is('post')){
            return view('templates/layout')
                .view('users/register')
                .view('templates/footer');
        }
        $post = $this->request->getPost(['name', 'email', 'password', 'confirmPassword']);
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required',
            'repeat_password' => 'matches[password]',
        ];
        if(! $this->validate($rules)){
            return view('templates/layout')
                .view('user/register')
                .view('templates/footer');
        }
        $userModel = model(UserModel::class);
        $data = [
            'name' => $post['name'],
            'email' => $post['email'],
            'password' => password_hash($post['password'] ,PASSWORD_DEFAULT)
        ];
        $userModel->save($data);
        return view('templates/layout')
            . view('templates/header', ['title' => 'NEWS'])
            . view('news/index')
            . view('templates/footer');
    }
}