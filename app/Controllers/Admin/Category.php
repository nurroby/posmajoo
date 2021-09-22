<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public $_folder;

    public function __construct()
    {
        helper('form');
        $this->validating = \Config\Services::validation();
        $this->thumbs = \Config\Services::image();
        $this->_folder = 'public/uploads/categories';
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
                'image' => implode('-',explode(' ',$this->request->getPost('name'))).'-'.$file->getRandomName()
            ]; 
            if(!$this->validating->run($input,'createCategory')):
                array_push($data,['validation' => $this->validating->getErrors()]);
                foreach($this->validating->getErrors() as $error ):
                    $this->session->setFlashdata('errors', $error); 
                endforeach;
                return view('admin/category-create',$data);
            endif;
            if($this->thumbs->withFile($file)
                        ->fit(100, 100, 'center')
                        ->save(ROOTPATH.$this->_folder.'/thumb/'.$input['image'])):
                if(!$file->move(ROOTPATH.$this->_folder.'/img/',$input['image']))
                {
                    $this->session->setFlashdata('errors', 'Failed to upload image');
                    return view('admin/category-create',$data);
                }
            endif;
            $tables = new CategoryModel();            
            if($tables->save($input)) {
                $this->session->setFlashdata('success', "Successfully insert data");
                $this->session->setFlashdata('redirect', base_url().'/admin/category');
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
            $file = $this->request->getFile('image');
                if($this->request->getPost('name')): $input['name'] = $this->request->getPost('name'); endif;
                if($this->request->getPost('description')): $input['description'] = $this->request->getPost('description') ; endif;
                if($file->getName()):
                    if($this->request->getPost('name')):
                        $input['image'] = implode('-',explode(' ',$this->request->getPost('name'))).'-'.$file->getRandomName();
                    else:
                        $input['image'] = implode('-',explode(' ',$val['name'])).'-'.$file->getRandomName();
                    endif; 
                endif;
                if(!$this->validating->run($input,'editCategory')):
                    array_push($data,['validation' => $this->validating->getErrors()]);
                    foreach($this->validating->getErrors() as $error ):
                        $this->session->setFlashdata('errors', $error); 
                    endforeach;
                    return view('admin/category-update',$data);
                endif;
                if(array_key_exists("image",$input)):
                    if($this->thumbs->withFile($file)
                                ->fit(100, 100, 'center')
                                ->save(ROOTPATH.$this->_folder.'/thumb/'.$input['image'])):
                        if(!$file->move(ROOTPATH.$this->_folder.'/img/',$input['image']))
                        {
                            $this->session->setFlashdata('errors', 'Failed to upload image');
                            return view('admin/category-update',$data);
                        }
                    endif;
                endif;       
                if($tables->update(['id'=>$id],$input)) {
                    $this->session->setFlashdata('success', "Successfully update data");
                    $this->session->setFlashdata('redirect', base_url().'/admin/category');
                }else{
                    $this->session->setFlashdata('error', $tables->errors());
                }
        endif;
        
        return view('admin/category-update',$data);
    }

    public function delete($id)
    {
        $tables = new CategoryModel();
            if(!$tables->delete($id)):            
                $this->session->setFlashdata('errors', $tables->errors());
            endif;          
    }
}
