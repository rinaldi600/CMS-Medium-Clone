<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {

//        CHECK COOKIE & SESSION
        helper('cookie');
        if (isset($_COOKIE['test'])) {
            return redirect()->to("/main");
        } else {
            if (session()->get('token') && session()->get('email')) {
                $db = \Config\Database::connect();
                $authModel = new \App\Models\AuthModel();
                try {
                    $authModel->where('email',session()->get('email'))->set('token',bin2hex(random_bytes(10)))->update();
                    if ($db->affectedRows()) {
                        session()->destroy();
                    }
                } catch (\Exception $e) {

                }
            } else if (session()->get('idAuthor') && session()->get('username')) {
                session()->destroy();
            }
            else {
                session()->destroy();
            }
        }

        return view("Login/Login");
    }

    public function signIn() {

        $validation =  \Config\Services::validation();

        $validation->setRules([
                'username' => [
                    'label'  => 'Username',
                    'rules'  => 'required|min_length[5]|alpha_numeric',
                    'errors' => [
                        'min_length' => '{field} minimum 5 characters',
                        'required' => 'All accounts must have {field} provided',
                        'alpha_numeric' => "{field} there can't spaces or special characters",
                    ]
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required|min_length[8]|alpha_numeric',
                    'errors' => [
                        'min_length' => '{field} minimum 8 characters',
                        'required' => 'All accounts must have {field} provided',
                        'alpha_numeric' => "{field} there can't spaces"
                    ]
                ],
            ]
        );

        if ($validation->withRequest($this->request)->run()) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $authorModel = new \App\Models\AuthorModel();

            if (count($authorModel->where('username',$username)->find()) > 0) {
                $passwordHashCode = $authorModel->where('username',$username)->find()[0]["password"];
                if (password_verify($password,$passwordHashCode)) {
                    session()->set([
                        'idAuthor' => $authorModel->where('username',$username)->find()[0]["idAuthor"],
                       'username' => $authorModel->where('username',$username)->find()[0]["username"],
                    ]);
                    if ($this->request->getPost('check')) {
                        helper('cookie');
                        setcookie("test",$username,time()+3600,"/");
                    }
                    return redirect()->to("/main");
                } else {
                    session()->setFlashdata('wrongPassword','Password Wrong');
                    return redirect()->to("/")->withInput();
                }
            } else {
                session()->setFlashdata('notFound','Username Not Found');
                return redirect()->to("/")->withInput();
            }
        } else {
            session()->setFlashdata([
               'username' => $validation->getError('username'),
               'password' => $validation->getError('password')
            ]);
            return redirect()->to("/")->withInput();
        }
    }
}
