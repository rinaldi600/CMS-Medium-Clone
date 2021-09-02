<?php

namespace App\Controllers;

class SignUp extends BaseController
{
    public function index()
    {
        return view("SignUp/SignUp");
    }

    public function signup() {

        $db = \Config\Database::connect();

        $validation =  \Config\Services::validation();

        $validation->setRules([
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|is_unique[author.email]|valid_email',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'is_unique' => '{field} already exists',
                        'valid_email' => 'Format must be a {field}'
                    ]
                ],
                'username' => [
                    'label'  => 'Username',
                    'rules'  => 'required|min_length[5]|alpha_numeric|is_unique[author.username]',
                    'errors' => [
                        'min_length' => '{field} minimal 5 characters',
                        'required' => 'All accounts must have {field} provided',
                        'alpha_numeric' => "{field} there can't spaces or special characters",
                        'is_unique' => '{field} already exists',
                    ]
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required|min_length[8]|alpha_numeric',
                    'errors' => [
                        'min_length' => '{field} minimal 8 characters',
                        'required' => 'All accounts must have {field} provided',
                        'alpha_numeric' => "{field} there can't spaces"
                    ]
                ],
                'confirmPassword' => [
                    'label'  => 'Confirm Password',
                    'rules'  => 'required|matches[password]',
                    'errors' => [
                        'matches' => '{field} must be the same',
                        'required' => 'All accounts must have {field} provided',
                    ]
                ],
                'picture' => [
                    'label'  => 'Picture Profile',
                    'rules'  => 'uploaded[picture]|is_image[picture]|max_dims[picture,300,300]|max_size[picture,2048]|ext_in[picture,jpg,jpeg,png]',
                    'errors' => [
                        'is_image' => '{field} must be images',
                        'uploaded' => '{field} must be uploaded',
                        'max_size' => '{field} max size images 2040KB',
                        'max_dims' => '{field} max dimension 300 x 300',
                        'ext_in' => '{field} format must be jpg, jpeg, png'
                    ]
                ]
            ]
        );


        if ($validation->withRequest($this->request)->run()) {

            $authorModel = new \App\Models\AuthorModel();
            $authModel = new \App\Models\AuthModel();

            $idAuthor = new \DateTime();
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);
            $getPicture = $this->request->getFile('picture');
            $createRandomName = $getPicture->getRandomName();

            try {

                $authorModel->insert([
                    'idAuthor' => (string) $idAuthor->getTimestamp(),
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'picture' => $createRandomName
                ]);
                $getPicture->move('picture-profile',$createRandomName);

                if ($db->affectedRows()) {
                    $authModel->insert([
                        'email' => $email,
                        'token' =>  bin2hex(random_bytes(10))
                    ]);

                    if ($db->affectedRows()) {
                        session()->setFlashdata('success','Account created successfully');
                        return redirect()->to("/signup");
                    }

                }


            } catch (\ReflectionException $e) {

            } catch (\Exception $e) {

            }
        } else {
            session()->setFlashdata([
                'email' => $validation->getError('email'),
                'username' => $validation->getError('username'),
                'password' => $validation->getError('password'),
                'confirmPassword' => $validation->getError('confirmPassword'),
                'picture' => $validation->getError('picture'),
            ]);
            return redirect()->to("/signup")->withInput();
        }
    }

}
