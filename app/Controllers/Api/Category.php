<?php

namespace App\Controllers\Api;
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
use App\Models\CategoryModel;

class Category extends BaseApi
{
    public function index()
    {
        $respond = $this->checkRequest('get', 'viewRules');
        //$data = json_decode(file_get_contents('php://input'), true);
        $data = $this->request->getVar();
        $category = new CategoryModel();
        if (isset($data['id'])) {
            $categoryData = $category->find($data['id']);
            if ($categoryData) {
                $respond = array('respond' => true, 'status' => 200, 'message' => 'Succesfully Retrieve Category Data', 'Category' => $CategoryData);
            } else {
                $respond = array('respond' => false, 'status' => 404, 'message' => 'Failed To Retrieve Category Data. Category ID Not Found');
            }
        } elseif (isset($data['draw'])) {
            $categoryData = $category->getAllCategoryDataTable($data);
            $respond = array(
                'respond'       => true,
                'status'        => 200,
                'message'       => 'Succesfully Retrieve Category Data',
                'Category'       => $categoryData,
            );
        } else {
            $categoryData = $category->orderBy('updated_at', 'desc')->findAll();
            $respond = array('respond' => true, 'status' => 200, 'message' => 'Succesfully Retrieve Category Data', 'category' => $categoryData);
        }
        return $this->sendRespond($respond);
    }

    public function addCategory()
    {
        $respond = $this->checkRequest('post', 'addCategoryRules');
        if ($respond['respond']) {
            $respond = $this->auth_admin();
            if ($respond['respond']) {
                $category = new CategoryModel();
                $data = json_decode(file_get_contents('php://input'), true);
                unset($data['id']);
                $category->save($data);
                $id = $category->getInsertID();
                $categoryData = $category->find($id);
                $respond = array('respond' => true, 'status' => 201, 'message' => 'Succesfully Add Category', 'category' => $categoryData);
            }
        }
        return $this->sendRespond($respond);
    }

    public function editCategory()
    {
        $respond = $this->checkRequest('patch', 'editCategoryRules');
        if ($respond['respond']) {
            $respond = $this->auth_admin();
            if ($respond['respond']) {
                $data = json_decode(file_get_contents('php://input'), true);
                $category = new CategoryModel();
                $categoryData = $category->find($data['id']);
                if ($categoryData) {
                    $category->save($data);
                    $categoryData = $category->find($data['id']);
                    $respond = array('respond' => true, 'status' => 200, 'message' => 'Succesfully Edit Category', 'category' => $categoryData);
                } else {
                    $respond = array('respond' => false, 'status' => 404, 'message' => 'Failed To Update Category. Category ID Not Found');
                }
            }
        }
        return $this->sendRespond($respond);
    }

    public function deleteCategory()
    {
        $respond = $this->checkRequest('delete', 'deleteRules');
        if ($respond['respond']) {
            $respond = $this->auth_admin();
            if ($respond['respond']) {
                $data = json_decode(file_get_contents('php://input'), true);
                $category = new CategoryModel();
                $categoryData = $category->find($data['id']);
                if ($categoryData) {
                    $category->delete($data['id']);
                    $respond = array('respond' => true, 'status' => 200, 'message' => 'Succesfully Delete Category');
                } else {
                    $respond = array('respond' => false, 'status' => 404, 'message' => 'Failed To Delete Category. Category ID Not Found');
                }
            }
        }
        return $this->sendRespond($respond);
    }
}
