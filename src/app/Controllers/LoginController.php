<?php

namespace App\Controllers;

use App\Models\User;

class LoginController extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function authenticate()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ], [
            'email' => [
                'required' => 'Email обязателен',
                'valid_email' => 'Формат email не соблюдается'
            ],
            'password' => [
                'required' => 'Пароль обязателен',
                'min_length' => 'Минимальная длина пароля 6 символов'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new User();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set('user', $user);
            return redirect()->to('/messages/1');
        } else {
            return redirect()->back()->withInput()->with('error', 'Неверный email или пароль');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}

?>