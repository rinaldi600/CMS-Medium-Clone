<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $contentModel = new \App\Models\ContentModel();
        $data = [
            'dataPublish' => $contentModel->select('idContent,title,username,picture,created_at,status')->join('author','author.idAuthor = content.idAuthor')->findAll()
        ];
        return view("Home/Home",$data);
    }

    public function detail($id) {
        $contentModel = new \App\Models\ContentModel();
        $getDetail = $contentModel->select("username,title,deskripsi,created_at,picture")->join('author','author.idAuthor = content.idAuthor')->where('idContent',$id)->find();

        if (count($getDetail) <= 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
//        d(date("D M j", strtotime("2011-01-07")));
        $data = [
          'detailContent' => $getDetail
        ];
        return view('Home/Detail',$data);
    }
}
