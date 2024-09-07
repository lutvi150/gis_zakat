<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    function login()
    {
        $data['head'] = 'Login';
        $session = \Config\Services::session();
        if ($session->get('login') === true) {
            if ($session->get('role') == 'administrator') {
                return redirect()->to('/administrator');
            } else {
                return redirect()->to('/');
            }
        } else {
            return view('login', $data);
        }
    }
    function logint_aut()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required',
        ], [
            'email' => [
                'required' => 'Email tidak boleh kosong',
                'valid_email' => 'Email tidak valid',
            ],
            'password' => [
                'required' => 'password tidak boleh kosong',
            ],
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'message' => $validation->getErrors(),
            ];
        } else {
            $email = $this->request->getPost('email');
            $password = hash('sha256', $this->request->getPost('password'));
            $user = new User();
            $get_email = $user->where('email', $email)->first();
            if ($get_email == null) {
                $response = [
                    'status' => 'email_not_found',
                    'message' => 'email tidak ditemukan',
                ];
            } else {
                $get_email = $user->where('email', $get_email->email)->where('password', $password)->first();
                if ($get_email) {
                    $session = \Config\Services::session();
                    $new_session = [
                        'login' => true,
                        'email' => $get_email->email,
                        'id' => $get_email->id,
                        'role' => $get_email->role,
                    ];
                    $session->set($new_session);
                    $response = [
                        'status' => 'success',
                        'message' => 'login berhasil',
                    ];
                } else {
                    $response = [
                        'status' => 'password_not_same',
                        'message' => 'password tidak sama',
                    ];
                }
            }
        }
        return $this->respond($response, 200);
    }
    function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to('/');
    }
}
