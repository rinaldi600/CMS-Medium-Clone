<?php

namespace App\Controllers;

class Main extends BaseController
{
    public function index()
    {
        $sessionIDAuthor = session()->get('idAuthor');

        $modelPagination = new \App\Models\ContentModel();
        $modelAuthor = new \App\Models\AuthorModel();

//        GET VALUE SEARCH
        if ($this->request->getGet('keyword')) {
            $keyword = $this->request->getGet('keyword');
            $result = $modelPagination->like('title',$keyword);
        } else {
            $result = $modelPagination;
        }

//        PAGINATION NUMBER LIST CONTENT

        $perpage = 2;
        if ($this->request->getGet('page_content')) {
            $pageContent = (int) $this->request->getGet('page_content');
            $number = ($pageContent * $perpage) - ($perpage - 1);
        } else {
            $number = 1;
        }


        $data = [
            'users' => $result->paginate($perpage,'content'),
            'pager' => $result->pager,
            'usernameProfile' => $modelAuthor->where('idAuthor',$sessionIDAuthor)->find()[0]["username"],
            'picture' => $modelAuthor->where('idAuthor',$sessionIDAuthor)->find()[0]["picture"],
            'number' => $number
        ];

        return view("Main/Main",$data);
    }

    public function logout() {
        helper('cookie');
        session()->destroy();
        setcookie("test","logout",time()-3600,"/");
        return redirect()->to("/");
    }

    public function add() {
        $modelAuthor = new \App\Models\AuthorModel();
        $data = [
            'idAuthor' => session()->get()["idAuthor"],
            'idContent' => uniqid(),
            'picture' => $modelAuthor->where('idAuthor',session()->get('idAuthor'))->find()[0]["picture"],
            'usernameProfile' => $modelAuthor->where('idAuthor',session()->get('idAuthor'))->find()[0]["username"],
        ];
        return view("Main/Post", $data);
    }

    public function postAdd() {
        $db = \Config\Database::connect();
        $validation =  \Config\Services::validation();

        $validation->setRules([
                'title' => [
                    'label'  => 'Title',
                    'rules'  => 'required|alpha_numeric_space',
                    'errors' => [
                        'required' => 'All {field} must have provided',
                        'alpha_numeric_space' => '{field} cannot contain special characters'
                    ]
                ],
                'description' => [
                    'label'  => 'Description',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'All {field} must have provided',
                    ]
                ],
            ]
        );


        if ($validation->withRequest($this->request)->run()) {
            $contentModel = new \App\Models\ContentModel();

            $data = [
                'idContent' => $this->request->getPost('idContent'),
                'title'    => $this->request->getPost('title'),
                'deskripsi' => $this->request->getPost('description'),
                'idAuthor' => $this->request->getPost('idAuthor'),
                'status' => 'not_published'
            ];


            try {
                $contentModel->insert($data);

                if ($db->affectedRows()) {
                    session()->setFlashdata('successInsert','Content uploaded successfully');
                    return redirect()->back();
                }

            } catch (\ReflectionException $e) {

            }
        } else {
            session()->setFlashdata([
                'title' => $validation->getError('title'),
                'description' => $validation->getError('description'),
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function detail() {
        if ($this->request->isAJAX()) {
            $modelAuthor = new \App\Models\AuthorModel();
            return json_encode( $modelAuthor->select('username')->select('email')->select('picture')->where('idAuthor',$this->request->getPost('id'))->find());
        }
    }

    public function preview($id) {
        $modelAuthor = new \App\Models\AuthorModel();
        $contentModel = new \App\Models\ContentModel();
        $data = [
            'picture' => $modelAuthor->where('idAuthor',session()->get('idAuthor'))->find()[0]["picture"],
            'usernameProfile' => $modelAuthor->where('idAuthor',session()->get('idAuthor'))->find()[0]["username"],
            'title' => $contentModel->where('idContent',$id)->find()[0]["title"],
            'deskripsi' => $contentModel->where('idContent',$id)->find()[0]["deskripsi"],
        ];
        return view("Main/Preview",$data);
    }

    public function delete() {
        $contentModel = new \App\Models\ContentModel();
        $deleteModel = new \App\Models\DeleteModel();
        $db = \Config\Database::connect();


        $data = [
            'idAuthor'    => session()->get('idAuthor'),
            'title' => $contentModel->select('title')->where('idContent',$this->request->getPost('idContent'))->find()[0]["title"]
        ];

        try {
            $deleteModel->insert($data);

            if ($db->affectedRows()) {
                $contentModel->where('idContent',$this->request->getPost('idContent'))->delete();
                if ($db->affectedRows()) {
                    session()->setFlashdata('deleteAlert','Data deleted successfully');
                    return redirect()->to("/main");
                }
            }

        } catch (\ReflectionException $e) {

        }
    }

    public function update() {
        $contentModel = new \App\Models\ContentModel();
        $authorModel = new \App\Models\AuthorModel();

        $getIDContent = $this->request->getGet('idContent');

        $data = [
            'contentUpdate' => $contentModel->where('idContent',$getIDContent)->find()[0],
            'picture' => $authorModel->select('picture')->where('idAuthor',session()->get('idAuthor'))->find()[0]["picture"],
            'usernameProfile' => $authorModel->select('username')->where('idAuthor',session()->get('idAuthor'))->find()[0]["username"]
        ];

        return view("Main/Update",$data);
    }

    public function updateData() {
        $db = \Config\Database::connect();
        $updateModel = new \App\Models\UpdateModel();
        $contentModel = new \App\Models\ContentModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
                'title' => [
                    'label'  => 'Title',
                    'rules'  => 'required|alpha_numeric_space',
                    'errors' => [
                        'required' => 'All {field} must have provided',
                        'alpha_numeric_space' => '{field} cannot contain special characters'
                    ]
                ],
                'description' => [
                    'label'  => 'Description',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'All {field} must have provided',
                    ]
                ],
            ]
        );
        if ($validation->withRequest($this->request)->run()) {
            $idAuthor = $this->request->getPost('idAuthor');
            $idContent = $this->request->getPost('idContent');
            $status = $this->request->getPost('status');
            $title = $this->request->getPost('title');
            $description = $this->request->getPost('description');

            $data = [
                'idAuthor' => session()->get('idAuthor'),
                'idContent' => $idContent
            ];

            try {
                $updateModel->insert($data);
                if ($db->affectedRows()) {
                    $dataContent = [
                        'title' => $title,
                        'deskripsi' => $description,
                        'idAuthor' => $idAuthor,
                        'status' => $status
                    ];
                    $contentModel->where('idContent',$idContent)->set($dataContent)->update();
                    if ($db->affectedRows()) {
                        session()->setFlashdata('updateMessage','Data has been successfully updated');
                        return redirect()->back();
                    }
                }
            } catch (\ReflectionException $e) {

            }
        } else {
            session()->setFlashdata([
                'title' => $validation->getError('title'),
                'description' => $validation->getError('description')
            ]);

            return redirect()->back()->withInput();
        }
    }

    public function publish() {
        $contentModel = new \App\Models\ContentModel();
        $db = \Config\Database::connect();

        $data = [
            'status' => 'published'
        ];
        try {
            $contentModel->where('idContent', $this->request->getPost('idContent'))->set($data)->update();
            if ($db->affectedRows()) {
                session()->setFlashdata('publishAlert' , 'Data published successfully');
                return redirect()->to("/main");
            }
        } catch (\ReflectionException $e) {

        }
    }

    public function cancelPublish() {
        $contentModel = new \App\Models\ContentModel();
        $db = \Config\Database::connect();

        $data = [
            'status' => 'not_published'
        ];
        try {
            $contentModel->where('idContent', $this->request->getPost('idContent'))->set($data)->update();
            if ($db->affectedRows()) {
                session()->setFlashdata('cancelPublishAlert' , 'data successfully unpublished from blog');
                return redirect()->to("/main");
            }
        } catch (\ReflectionException $e) {

        }
    }
}
