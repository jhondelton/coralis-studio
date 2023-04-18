<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Debug\Toolbar\Collectors\Logs;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\IncomingRequest;

class Login extends BaseController {
    public function get() {
        if (session()->has('user')) return redirect()->to(base_url('/'));
        return view('auth/login');
    }
    public function post() {
        if ($this->request->isAJAX() == false) throw PageNotFoundException::forPageNotFound();
        $validated = $this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_not_unique[users.email]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|alpha_numeric'
            ],
        ]);
        if ($validated) {
            $inputData = [
                'email'    => escape_input($this->request->getPost('email')),
                'password' => escape_input($this->request->getPost('password'))
            ];
            $userModel = new UserModel();
            $user = $userModel->where('email', $inputData['email'])->first();
            if ($user) {
                if (!password_verify($inputData['password'], $user['password'])) {
                    return response()->setJSON([
                        'status'  => false, 
                        'type'    => 'alert',
                        'message' => 'Password salah.'
                    ]);
                }
                if ($user['status'] == 'unverified') {
                    $mailer = \Config\Services::email();
                    $mailer->setTo($user['email']);
                    $mailer->setSubject('Verifikasi Akun');
                    $message =  view('mail/auth/verify', [
                        'content' => [
                            'token' => $user['email_verify_token'],
                            'url'   => base_url('auth/verify/'.$user['email_verify_token'])
                        ],
                        'receiver' => [
                            'name' => $user['name']
                        ]
                    ]);
                    $mailer->setMessage($message);
                    if ($mailer->send()) {
                        return response()->setJSON([
                            'status'   => true, 
                            'type'     => 'sweetalert',
                            'timeout'  => 5000,
                            'message'  => 'Periksa email anda untuk verifikasi akun anda.',
                        ]);
                    } else {
                        return response()->setJSON([
                            'status'  => false, 
                            'type'    => 'alert',
                            'message' => 'Terjadi kesalahan pada konfigurasi email/smtp.'
                        ]);
                    }
                }
                session()->setFlashdata('alert', [
                    'type'    => 'normal',
                    'alert'   => 'success', 
                    'title'   => 'Berhasil', 
                    'message' => 'Selamat datang <b>'.$user['name'].'</b>.',
                    'timeout' => 8000,
                    'size'    => 'col-lg-12'
                ]);
                session()->set('user', $user['id']);
                return response()->setJSON([
                    'status'   => true, 
                    'type'     => 'normal',
                    'timeout'  => 1000,
                    'message'  => 'Anda akan segera dialihkan secara otomatis.',
                    'redirect' => base_url('/')
                ]);
            }
        } else {
            $errors = $this->validator->getErrors();
            return response()->setJSON([
                'status'  => false, 
				'type'    => 'validation',
				'message' => $errors
            ]);
        }       
    }
}
