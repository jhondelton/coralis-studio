<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Debug\Toolbar\Collectors\Logs;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\IncomingRequest;

class Register extends BaseController {
    public function get() {
        if (session()->has('user')) return redirect()->to(base_url('/'));
        return view('auth/register');
    }
    public function post() {
        if ($this->request->isAJAX() == false) throw PageNotFoundException::forPageNotFound();
        $validated = $this->validate([
            'name' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|alpha_space|is_unique[users.name]|max_length[20]'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|alpha_numeric|max_length[20]'
            ],
        ]);
        if ($validated) {
            $inputData = [
                'name'               => escape_input($this->request->getPost('name')),
                'email'              => escape_input($this->request->getPost('email')),
                'password'           => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'avatar'             => 'default.jpg',
                'email_verify_token' => md5($this->request->getVar('name').rand(0,999999))
            ];
            $userModel = new UserModel();
            $save = $userModel->save($inputData);
            if ($save) {
                $mailer = \Config\Services::email();
                $mailer->setTo($inputData['email']);
                $mailer->setSubject('Verifikasi Akun');
                $message =  view('mail/auth/verify', [
                    'content' => [
                        'token' => $inputData['email_verify_token'],
                        'url'   => base_url('auth/verify/'.$inputData['email_verify_token'])
                    ],
                    'receiver' => [
                        'name' => $inputData['name']
                    ]
                ]);
                $mailer->setMessage($message);
                if ($mailer->send()) {
                    session()->setFlashdata('alert', [
                        'type'    => 'normal',
                        'alert'   => 'success', 
                        'title'   => 'Berhasil', 
                        'message' => 'Akun anda berhasil didaftarkan, periksa email anda.',
                        'timeout' => 8000,
                        'size'    => 'col-lg-12'
                    ]);
                    return response()->setJSON([
                        'status'   => true, 
                        'type'     => 'normal',
                        'timeout'  => 1000,
                        'message'  => 'Anda akan segera dialihkan secara otomatis.',
                        'redirect' => base_url('auth/login')
                    ]);
                } else {
                    return response()->setJSON([
                        'status'  => false, 
                        'type'    => 'alert',
                        'message' => 'Terjadi kesalahan pada konfigurasi email/smtp.'
                    ]);
                }
            } else {
                return response()->setJSON([
                    'status'  => false, 
                    'type'    => 'alert',
                    'message' => 'Terjadi kesalahan pada konfigurasi email/smtp.'
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
