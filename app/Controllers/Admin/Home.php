<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\AdminModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Home extends BaseController
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
            return redirect()->to(base_url().'/admin/login');
        }
        $_users = new UserModel();
        $_order = new OrderModel();
        $_product = new ProductModel();
        $_category = new CategoryModel();
        $data = [
            "page_title"=>"add category",
            "page_type"=>"dashboard",
            "count"=>[
                "order"=>$_order->countAllResults(),
                "user"=>$_users->countAllResults(),
                "product"=>$_product->countAllResults(),
                "category"=>$_category->countAllResults(),
            ],
            "latest"=>[
                "order"=>$_order->select('id as order_id, user_id, total_price, status')
                                ->orderBy('created_at','desc')
                                ->findAll(5,0),
                "product"=>$_product->select('id as product_id, name, description, price, image')
                                    ->orderBy('created_at','desc')
                                    ->findAll(5,0),
            ]
        ];
        return view('admin/dashboard',$data);
    }

    public function login()
    {
        $data = ["page_title"=>"Login","page_type"=>"none"];
        if ($this->request->getPost()): 
            $input = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password')
            ]; 
            if(!$this->validating->run($input,'loginadmin')):
                array_push($data,['validation' => $this->validating->getErrors()]);
                foreach($this->validating->getErrors() as $error ):
                    $this->session->setFlashdata('errors', $error); 
                endforeach;
                return view('admin/login',$data);
            endif;
            $tables = new AdminModel();
            $res = $tables->where(['username'=>$input['username']])->first();
            if(hash_equals($res['password'], crypt($input['password'], $res['password']))) {
                $sessionArray = array(
                    'userId' => $res['id'],
                    'username' => $res['username'],
                    'name' => $res['name'],
                    'role' => 'admin'
                );
                $this->session->setFlashdata('success', "Redirecting to admin");
                $this->session->setFlashdata('redirect', base_url().'/admin');
                $this->session->set($sessionArray);
            } else {
                $this->session->setFlashdata('errors', "Credentials wrong");
                sleep(3);
            }
        endif;
        return view('admin/login',$data);
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to(base_url().'/admin');
    }
}
