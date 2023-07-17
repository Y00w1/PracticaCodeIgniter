<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Your profile',
            'user'=>session()->get('isLoggedIn') ? session()->get('user') : null,
        ];
        return view('templates/layout')
            .view('templates/header', $data)
            .view('users/profile', $data)
            .view('templates/footer');
    }
    public function edit()
    {
        $model = model(UserModel::class);
        $user = session()->get('isLoggedIn') ? session()->get('user') : null;
        $data = [
            'title' => 'Your profile',
            'user' => $user,
        ];
        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/layout')
                . view('templates/header', $data)
                . view('user/profile', $data)
                . view('templates/footer');
        }
        $post = $this->request->getPost(['name', 'email']);
        if (! $this->validateData($post, [
            'name' => 'required',
            'email'  => 'required|email',
        ])) {
            // The validation fails, so returns the form.
            return view('templates/layout')
                . view('templates/header', $data)
                . view('user/profile', $data)
                . view('templates/footer');
        }
        $model->update($user['id'],$post);
        return $this->response->redirect(site_url('/user/profile'));
    }
    public function updatePassword()
    {
        $model = model(UserModel::class);
        $user = session()->get('isLoggedIn') ? session()->get('user') : null;
        $data = [
            'title' => 'Your profile',
            'user' => $user,
        ];
        // Checks if the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/layout')
                . view('templates/header', $data)
                . view('user/profile', $data)
                . view('templates/footer');
        }
        $post = $this->request->getPost(['current_password', 'password', 'confirm_password']);
        $userData = $model->find($user['id']);
        if (! password_verify($post['password'], $userData['password'])){
            //TODO: show a notification about this error
            return view('templates/layout')
                . view('templates/header', $data)
                . view('user/profile', $data)
                . view('templates/footer');
        }
        if (!$this->validateData($post, [
            'current_password' => 'required',
            'password' => 'required',
            'confirmPassword'  => 'required|matches[password]',
        ])) {
            // The validation fails, so returns the form.
            //TODO: return the form view with validation errors.
            return view('templates/layout')
                . view('templates/header', $data)
                . view('user/profile', $data)
                . view('templates/footer');
        }
        $new_password = password_hash($post['password'], PASSWORD_DEFAULT);
        $model->update($user['id'],['password' => $new_password]);
        session()->setFlashdata('success', 'Password updated successfully');
        //TODO: show a notification about the password change
        return $this->response->redirect(site_url('/user/profile'));
    }
}