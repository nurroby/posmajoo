<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->form_validation = \Config\Services::validation();
        $register = [
            'username' => 'required|alpha_numeric|min_length[5]|max_length[20]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]|max_length[20]'
        ];
    }

    public function index()
    {
        if(!$this->isAdmin())
        {    
            $this->session->setFlashdata('errors', 'Session Expired, silakan login ulang');
            return redirect()->to(base_url().'/admin/login');
        }
        $data = ["page_title"=>"add category","page_type"=>"dashboard"];
        return view('admin/dashboard',$data);
    }

    public function auth(){
        $username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$params = [
			'username' => $username,
			'password' => $password
		];
		$url = base_url().'/api/admin/login';
		$method = 'POST';
		$response = json_decode($this->sendRequest($url, $method, $params), true);
		if ($response['status'] == '200') {
			$sessionArray = array(
				'userId' => $response['admin']['id'],
				'username' => $response['admin']['username'],
				'name' => $response['admin']['name'],
				'role' => 'admin',
				'token' => $response['authentication']['token'],
				'token_exp' => $response['authentication']['expired_at'],
			);
			$this->session->set($sessionArray);
			return redirect('/');
		} else {
			$this->session->setFlashdata('errors', $response['message']);
			return redirect('/login');
		}
    }

    public function login()
    {
        if ($this->request->getPost()):
            
        endif;
        $data = ["page_title"=>"Login","page_type"=>"none"];
        return view('admin/login',$data);
    }

    public function logout()
    {

    }
}
