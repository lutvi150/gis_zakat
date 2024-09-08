<?php

namespace App\Controllers;

use App\Models\Bantuan;
use App\Models\User;
use App\Models\Zakat;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    public function index(): string
    {
        $bantuan = new Bantuan();
        $zakat = new Zakat();
        $data['title'] = 'Admin Dashboard';
        $data['zakat'] = $zakat->orderBy('created_at', 'desc')->findAll();
        $data['total_disalurkan'] = $bantuan->selectSum('total_bantuan')->findAll()[0]['total_bantuan'];
        $data['total_dana'] = $zakat->orderBy('created_at', 'desc')->first()['saldo_akhir'];
        $data['bantuan'] = $bantuan->asObject()->where('id_zakat !=', 0)->findAll();
        return view('welcome_message', $data);
    }
    function login()
    {
        $data['title'] = 'Login';
        $session = \Config\Services::session();
        if ($session->get('login') === true) {
            if ($session->get('role') == 'admin') {
                return redirect()->to('/admin');
            } else {
                return redirect()->to('/');
            }
        } else {
            return view('login', $data);
        }
    }
    function login_auth()
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
                $get_email = $user->where('email', $get_email['email'])->where('password', $password)->first();
                if ($get_email) {
                    $session = \Config\Services::session();
                    $new_session = [
                        'login' => true,
                        'email' => $get_email['email'],
                        'id' => $get_email['id'],
                        'role' => $get_email['role'],
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
