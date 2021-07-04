<?php

class Home extends Controller
{

    public function __construct()
    {
        $this->usersModel = $this->model('usersModel');
    }

    public function index()
    {
        $data = [
            'pembuat' => 'Marthin Alfreinsco Salakory',
            'alamat' => 'Kota Ambon',
            'contact' => [
                'whatsapp' => '081318812027',
                'facebook' => 'Mathin Alfreinsco Salakory',
                'twiter' => 'Mathin Alfreinsco Salakory',
                'instagram' => 'Mathin Alfreinsco Salakory'
            ],
        ];
        $this->view('index', $data);
    }
}
