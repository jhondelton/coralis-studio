<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Debug\Toolbar\Collectors\Logs;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\IncomingRequest;

class Reset extends BaseController {
    public function get(string $token = '') {
        if (session()->has('user')) return redirect()->to(base_url('/'));
        if (!$token) {
            return view('auth/reset');
        } else {
            $userModel = new UserModel();
            $user = $userModel->where('email_reset_token', $token)->first();
            if ($user) {
                return view('auth/change-password');
            } else {
                throw PageNotFoundException::forPageNotFound();
            }
        }
    }
    public function post(string $token = '') {
        if ($this->request->isAJAX() == false) throw PageNotFoundException::forPageNotFound();
        if (!$token) {
            $validated = $this->validate([
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_not_unique[users.email]'
                ],
            ]);
            if ($validated) {
                $inputData = [
                    'email'    => escape_input($this->request->getPost('email')),
                ];
                $userModel = new UserModel();
                $user = $userModel->where('email', $inputData['email'])->first();
                if ($user) {
                    if ($user['status'] == 'unverified') {
                        return response()->setJSON([
                            'status'  => false, 
                            'type'    => 'alert',
                            'message' => 'Akun belum diverifikasi.'
                        ]);
                    }
                    $inputData['email_reset_token'] = md5($user['name'].rand(0,999999));
                    $mailer = \Config\Services::email();
                    $mailer->setTo($inputData['email']);
                    $mailer->setSubject('Lupa Password');
                    $message =  view('mail/auth/reset', [
                        'content' => [
                            'token' => $inputData['email_reset_token'],
                            'url'   => base_url('auth/reset/'.$inputData['email_reset_token'])
                        ],
                        'receiver' => [
                            'name' => $user['name']
                        ]
                    ]);
                    $mailer->setMessage($message);
                    if ($mailer->send()) {
                        $userModel->update($user['id'], $inputData);
                        session()->setFlashdata('alert', [
                            'type'    => 'normal',
                            'alert'   => 'success', 
                            'title'   => 'Berhasil', 
                            'message' => 'Periksa email anda untuk mengubah passsword anda.',
                            'timeout' => 8000,
                            'size'    => 'col-lg-12'
                        ]);
                        return response()->setJSON([
                            'status'   => true, 
                            'type'     => 'sweetalert',
                            'timeout'  => 5000,
                            'message'  => 'Periksa email anda untuk mengubah passsword anda.',
                        ]);
                    } else {
                        return response()->setJSON([
                            'status'  => false, 
                            'type'    => 'alert',
                            'message' => 'Terjadi kesalahan pada konfigurasi email/smtp.'
                        ]);
                    }
                }
            } else {
                $errors = $this->validator->getErrors();
                return response()->setJSON([
                    'status'  => false, 
                    'type'    => 'validation',
                    'message' => $errors
                ]);
            }  
        } else {
            $userModel = new UserModel();
            $user = $userModel->where('email_reset_token', $token)->first();
            if ($user) {
                $validated = $this->validate([
                    'new_password' => [
                        'label' => 'Password',
                        'rules' => 'required|alpha_numeric|max_length[20]'
                    ],
                    'confirm_new_password' => [
                        'label' => 'Password',
                        'rules' => 'required|matches[new_password]'
                    ],
                ]);
                if ($validated) {
                    $inputData = [
                        'password'          => password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT),
                        'email_reset_token' => null
                    ];
                    if ($user) {
                        $userModel->update($user['id'], $inputData);
                        session()->setFlashdata('alert', [
                            'type'    => 'normal',
                            'alert'   => 'success', 
                            'title'   => 'Berhasil', 
                            'message' => 'Password berhasil diubah, silahkan masuk.',
                            'timeout' => 8000,
                            'size'    => 'col-lg-12'
                        ]);
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
            } else {
                return response()->setJSON([
                    'status'  => false, 
                    'type'    => 'alert',
                    'message' => 'Pengguna tidak ditemukan.'
                ]);
            }
        }
    }
}
