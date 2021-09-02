<?php

namespace App\Controllers;

class ForgotPassword extends BaseController
{
    public function index()
    {
        if (session()->get()) {
            $db = \Config\Database::connect();
            $authModel = new \App\Models\AuthModel();
            try {
                $authModel->where('email',session()->get('email'))->set('token',bin2hex(random_bytes(10)))->update();
                if ($db->affectedRows()) {
                    session()->destroy();
                }
            } catch (\Exception $e) {

            }
        }

        return view('ForgotPassword/ViewsEmail');
    }

    public function verifyEmail() {
        $validation =  \Config\Services::validation();
        $validation->setRules([
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} must be provided',
                        'valid_email' => 'Invalid format {field}'
                    ]
                ]
            ]
        );
        if ($validation->withRequest($this->request)->run()) {

            $email = $this->request->getPost('email');
            $authModel = new \App\Models\AuthModel();
            $checkExistEmailInDatabase = count($authModel->where('email',$email)->find());

            if ($checkExistEmailInDatabase <= 0) {
                session()->setFlashdata('errorMessage','Email is not registered in the database');
                return redirect()->back()->withInput();
            } else {
                session()->set([
                    'token' => $authModel->where('email',$email)->find()[0]["token"],
                    'email' => $authModel->where('email',$email)->find()[0]["email"]
                ]);
                return redirect()->to("/forgotPassword/token");
            }

        } else {
            session()->setFlashdata('errorMessage',$validation->getError('email'));
            return redirect()->back()->withInput();
        }
    }

    public function token() {
        return view('ForgotPassword/ViewsToken');
    }

    public function verifyToken() {
        $validation =  \Config\Services::validation();
        $validation->setRules([
                'token' => [
                    'label'  => 'Token',
                    'rules'  => 'required|alpha_numeric',
                    'errors' => [
                        'required' => '{field} must be provided',
                        'alpha_numeric' => '{field} must be combine letters and numbers',
                    ]
                ]
            ]
        );
        if ($validation->withRequest($this->request)->run()) {
            $authModel = new \App\Models\AuthModel();
            if (count($authModel->select("*")->where('token',$this->request->getPost('token'))->find()) > 0) {
                session()->set([
                    'email' => $authModel->select("email")->where('token',$this->request->getPost('token'))->find()[0]["email"],
                ]);
                session()->remove('token');
                return redirect()->to("/forgotPassword/resetPassword");
            } else {
                session()->setFlashdata('errorMessage','Invalid Token');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('errorMessage',$validation->getError('token'));
            return redirect()->back()->withInput();
        }
    }

    public function resetPassword() {
        $authModel = new \App\Models\AuthModel();
        if (session()->get('email')) {
            try {
                $authModel->where('email', session()->get('email'))->set('token',bin2hex(random_bytes(10)))->update();
            } catch (\Exception $e) {
            }
        }
        return view("ForgotPassword/ViewsResetPassword");
    }

    public function verifyPassword() {
        $authorModel = new \App\Models\AuthorModel();
        $db = \Config\Database::connect();

        $validation =  \Config\Services::validation();
        $validation->setRules([
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required|min_length[8]|alpha_numeric',
                    'errors' => [
                        'required' => '{field} must be provided',
                        'min_length' => '{field} must be minimal 8 Character',
                        'alpha_numeric' => '{field} must be combine letters and numbers',
                    ]
                ],
                'confirmPassword' => [
                    'label'  => 'Confirm Password',
                    'rules'  => 'required|min_length[8]|alpha_numeric|matches[password]',
                    'errors' => [
                        'required' => '{field} must be provided',
                        'min_length' => '{field} must be minimal 8 Character',
                        'alpha_numeric' => '{field} must be combine letters and numbers',
                        'matches' => '{field} must be match with field password',
                    ]
                ]
            ]
        );
        if ($validation->withRequest($this->request)->run()) {
            try {
                $authorModel->where('email', session()->get('email'))->set('password', password_hash($this->request->getPost('password'),PASSWORD_DEFAULT))->update();
                if ($db->affectedRows()) {
                    session()->setFlashdata('successMessage','Password successfully has changed');
                    return redirect()->back();
                }
            } catch (\ReflectionException $e) {

            }
        } else {
            session()->setFlashdata([
                'password' => $validation->getError('password'),
                'confirmPassword' => $validation->getError('confirmPassword')
            ]);
            return redirect()->back();
        }
    }
}
