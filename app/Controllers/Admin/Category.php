<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validating = \Config\Services::validation();
    }

    public function index()
    {
        if(!$this->isAdmin())
        {    
            $this->session->setFlashdata('errors', 'Session Expired, silakan login ulang');
            return redirect('admin/login');
        }
        $data = ["page_title"=>"category","page_type"=>"list"];
        return view('admin/category',$data);
    }
    
    public function create()
    {
        $data = ["page_title"=>"add category","page_type"=>"form"];
        if ($this->request->getPost()): 
            $file = $this->request->getFile('image');
            $input = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'image' => $file->getClientName()
            ]; 
            
            if(!$this->validating->run($input,'addCategory')):
                array_push($data,['validation' => $this->validating->getErrors()]);
                foreach($this->validating->getErrors() as $error ):
                    $this->session->setFlashdata('errors', $error); 
                endforeach;
                return view('admin/category-create',$data);
            endif;

            if(!$file->move(WRITEPATH . 'uploads'))
            {
                $this->session->setFlashdata('errors', 'Failed to upload image');
                return view('admin/category-create',$data);
            }
            $tables = new CategoryModel();            
            if($tables->save($input)) {
                $this->session->setFlashdata('success', "Successfully insert data");
                $this->session->setFlashdata('redirect', base_url().'/admin');
            }
        endif;
        return view('admin/category-create',$data);
    }

    public function edit($id)
    {        
        $tables = new CategoryModel();
        $val = $tables->find($id);
        if(!$val){
            $this->session->setFlashdata('errors', "Data not Found");
            $this->session->setFlashdata('redirect', base_url().'/admin');
        }
        $data = ["page_title"=>"edit category","page_type"=>"form",'val'=>$val];
        if (!empty($this->request->getPost())): 
            $input = [];
                if($this->request->getPost('name')): $input['name'] = $this->request->getPost('name'); endif;
                if($this->request->getPost('description')): $input['description'] = $this->request->getPost('name') ; endif;
                if($this->request->getFile('image')): $input['name'] = $this->request->getPost('name') ; endif;
                if(!$this->validating->run($input,'editCategory')):
                    array_push($data,['validation' => $this->validating->getErrors()]);
                    foreach($this->validating->getErrors() as $error ):
                        $this->session->setFlashdata('errors', $error); 
                    endforeach;
                    return view('admin/category-update',$data);
                endif;

                if(!$input['image']->move(WRITEPATH . 'uploads'))
                {
                    $this->session->setFlashdata('errors', 'Failed to upload image');
                    return view('admin/category-update',$data);
                }          
                if($tables->insert($input)) {
                    $this->session->setFlashdata('success', "Successfully update data");
                    $this->session->setFlashdata('redirect', base_url().'/admin');
                }
        endif;
        
        return view('admin/category-update',$data);
    }

    public function delete($id)
    {
        $tables = new CategoryModel();
            if($tables->delete($input))
            {
                $this->session->setFlashdata('errors', 'Failed to remove data');
                $this->session->setFlashdata('redirect', base_url().'/admin/category');
            }          
            if($tables->insert($input)) {
                $this->session->setFlashdata('success', "Successfully remove data");
                $this->session->setFlashdata('redirect', base_url().'/admin/category');
            }
    }
}
