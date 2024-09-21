<?php

namespace App\Controllers;

use App\Models\User;

class RegisterController extends BaseController
{
    public function register()
    {
        return view('register');
    }

    public function newUser()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'min_length[3]|max_length[20]',
            'email' => 'valid_email|is_unique[user.email]',
            'password' => 'min_length[6]',
        ], [
            'username' => [
                'min_length' => 'Минимальная длина имени 3 символа',
                'max_length' => 'Максимальная длина имени 20 символов'
            ],
            'email' => [
                'valid_email' => 'Формат email не соблюдается',
                'is_unique' => 'Пользователь с указанным email уже существует'
            ],
            'password' => [
                'min_length' => 'Минимальная длина пароля 6 символов'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $user = new User();
        $user->save([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/login');
    }
}

?>