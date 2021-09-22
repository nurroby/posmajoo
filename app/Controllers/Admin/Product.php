<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validating = \Config\Services::validation();
        $this->thumbs = \Config\Services::image();
        $this->_folder = 'public/uploads/products';
    }

    public function index()
    {
        if(!$this->isAdmin())
        {    
            $this->session->setFlashdata('errors', 'Session Expired, silakan login ulang');
            return redirect('admin/login');
        }
        $data = ["page_title"=>"product","page_type"=>"list"];
        return view('admin/product',$data);
    }
    
    public function create()
    {
        $data = ["page_title"=>"Add Product","page_type"=>"form"];
        if ($this->request->getPost()): 
            $file = $this->request->getFile('image');
            $input = [
                'name' => $this->request->getPost('name'),
                'category_id' => $this->request->getPost('category_id'),
                'description' => $this->request->getPost('description'),
                'price' => $this->request->getPost('price'),
                'image' => implode('-',explode(' ',$this->request->getPost('name'))).'-'.$file->getRandomName()
            ]; 
            
            if(!$this->validating->run($input,'createProduct')):
                array_push($data,['validation' => $this->validating->getErrors()]);
                foreach($this->validating->getErrors() as $error ):
                    $this->session->setFlashdata('errors', $error); 
                endforeach;
                return view('admin/product-create',$data);
            endif;
            if($this->thumbs->withFile($file)
                        ->fit(100, 100, 'center')
                        ->save(ROOTPATH.$this->_folder.'/thumb/'.$input['image'])):
                if(!$file->move(ROOTPATH.$this->_folder.'/img/',$input['image']))
                {
                    $this->session->setFlashdata('errors', 'Failed to upload image');
                    return view('admin/product-create',$data);
                }
            endif;
            $tables = new ProductModel();            
            if($tables->save($input)) {
                $this->session->setFlashdata('success', "Successfully insert data");
                $this->session->setFlashdata('redirect', base_url().'/admin');
            }
        endif;
        return view('admin/product-create',$data);
    }

    public function edit($id)
    {        
        $tables = new ProductModel();
        $val = $tables->find($id);
        if(!$val){
            $this->session->setFlashdata('errors', "Data not Found");
            $this->session->setFlashdata('redirect', base_url().'/admin');
        }
        $data = ["page_title"=>"edit product","page_type"=>"form",'val'=>$val];
        if (!empty($this->request->getPost())): 
            $input = [];
                if($this->request->getPost('name')): $input['name'] = $this->request->getPost('name'); endif;
                if($this->request->getPost('category_id')): $input['category_id'] = $this->request->getPost('category_id'); endif;
                if($this->request->getPost('price')): $input['price'] = $this->request->getPost('price'); endif;
                if($this->request->getPost('description')): $input['description'] = $this->request->getPost('description') ; endif;
                if($this->request->getFile('image')):
                    if($this->request->getPost('name')):
                        $input['image'] = implode('-',explode(' ',$this->request->getPost('name'))).'-'.$file->getRandomName();
                    else:
                        $input['image'] = implode('-',explode(' ',$val['name'])).'-'.$file->getRandomName();
                    endif; 
                endif;
                if(!$this->validating->run($input,'editProduct')):
                    array_push($data,['validation' => $this->validating->getErrors()]);
                    foreach($this->validating->getErrors() as $error ):
                        $this->session->setFlashdata('errors', $error); 
                    endforeach;
                    return view('admin/product-update',$data);
                endif;

                if(!$input['image']->move(ROOTPATH.$this->_folder,$input['image']))
                {
                    $this->session->setFlashdata('errors', 'Failed to upload image');
                    return view('admin/product-update',$data);
                }          
                if($tables->update($input,['id'=>$id])) {
                    $this->session->setFlashdata('success', "Successfully update data");
                    $this->session->setFlashdata('redirect', base_url().'/admin');
                }
        endif;
        
        return view('admin/product-update',$data);
    }

    public function delete($id)
    {
        $tables = new ProductModel();
        if(!$tables->delete($id)):            
            $this->session->setFlashdata('errors', $tables->errors());
        endif;      
    }
}
