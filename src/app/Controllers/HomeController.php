<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        return redirect()->to('/messages/1');
    }
}