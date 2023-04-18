<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Auth extends BaseController {
    public function home()  {
        return view('auth/home');
    }
    public function verify(string $token) {
        $userModel = new UserModel();
        $user = $userModel->where('email_verify_token', $token)->first();
        if ($user) {
            $inputData = [
                'status'             => 'verified',
                'email_verify_token' => null
            ];
            $userModel->update($user['id'], $inputData);
            return redirect()->to(base_url('auth/login'))->with('alert', [
                'type'    => 'sweetalert',
                'alert'   => 'success', 
                'title'   => 'Berhasil', 
                'message' => 'Akun berhasil diverifikasi, silahkan masuk.',
                'timeout' => 5000,
                'size'    => 'col-lg-12'
            ]);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }
    public function updateAvatar() {
        if ($this->request->isAJAX() == false) throw PageNotFoundException::forPageNotFound();
        $validated = $this->validate([
            'avatar' => [
                'label' => 'Avatar',
                'rules' => [
                    'uploaded[avatar]',
                    'is_image[avatar]',
                    'max_size[avatar,4096]',
                ]
            ],
        ]);
        if ($validated) {
            $userModel = new UserModel();
            $inputData = [
                'avatar'    => $this->request->getFile('avatar'),
            ];
            $inputData['avatar']->move(FCPATH.'uploads', $filename = $inputData['avatar']->getRandomName());
            $inputData['avatar'] = $filename;
            $user = $userModel->update(user(), $inputData);
            return response()->setJSON([
                'status'   => true, 
                'type'     => 'normal',
                'timeout'  => 1000,
                'message'  => 'Avatar anda berhasil diperbarui.',
                'redirect' => base_url('/'),
            ]);
        } else {
            $errors = $this->validator->getErrors();
            return response()->setJSON([
                'status'  => false, 
				'type'    => 'validation',
				'message' => $errors
            ]); 
        }
    }
    public function logout() {
        if (!session()->has('user')) return redirect()->to(base_url('auth/login'));
        session()->remove('user');
        return redirect()->to(base_url('auth/login'))->with('alert', [
            'type'    => 'sweetalert',
            'alert'   => 'success', 
			'title'   => 'Berhasil', 
			'message' => 'Sampai jumpa lagi...',
            'timeout' => 5000,
            'size'    => 'col-lg-12'
		]);
    }
}
