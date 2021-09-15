<?php

namespace App\Controllers\V1;

// Copyright 2021 Nurroby Wahyu Saputra
// 
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
// 
//     http://www.apache.org/licenses/LICENSE-2.0
// 
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

use App\Controllers\BaseApi;
use App\Models\AdminAuthenticationModel;
use App\Models\AdminModel;

class Admin extends BaseApi
{
    public function __construct()
	{
		parent::__construct();
		if (!$this->isLoggedIn()) {
			return redirect('/login');
		}
    }

    public function login()
    {
        $respond = $this->checkRequest('post', 'loginRules');
        if ($respond['respond']) {
            $data = json_decode(file_get_contents('php://input'), true);
            $admin = new AdminModel();
            $auth = $admin->auth($data);
            if ($auth['respond']) {
                $authentication = new AdminAuthenticationModel();
                $authentication->save(array('user_id' => $auth['id']));
                $id = $authentication->getInsertID();
                $authenticationData = $authentication->find($id);
                $adminData = $admin->find($auth['id']);
                unset($adminData['password'], $adminData['deleted_at'], $authenticationData['id'], $authenticationData['user_id'], $authenticationData['created_at'], $authenticationData['updated_at']);
                $respond = array('respond' => true, 'status' => 200, 'message' => 'Succesfully Logged In', 'admin' => $adminData, 'authentication' => $authenticationData);
            } else {
                $respond = array('respond' => false, 'status' => 400, 'message' => 'Username & Password Combination Does Not Exist', 'status_message' => 'Authorization Error');
            }
        }
        return $this->sendRespond($respond);
    }
}