<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Category extends BaseController
{
    public function index()
    {
        if(!$this->isAdmin())
        {    
            $this->session->set_flashdata('errors', 'Session Expired, silakan login ulang');
            return redirect('admin/login');
        }
        $data = ["page_title"=>"category","page_type"=>"list"];
        return view('admin/category',$data);
    }
    
    public function create()
    {
        $data = ["page_title"=>"add category","page_type"=>"form"];
        return view('admin/category-create',$data);
    }

    public function update()
    {
        $data = ["page_title"=>"edit category","page_type"=>"form"];
        return view('admin/category-update',$data);
    }
}
