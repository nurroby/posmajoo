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
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseApi
{
    public function index()
    {
        $respond = $this->checkRequest('get', 'viewRules');
        //$data = json_decode(file_get_contents('php://input'), true);
        $data = $this->request->getVar();
        $product = new ProductModel();
        $category = new CategoryModel();
        if (isset($data['id'])) {
            $productData = $product->find($data['id']);
            if ($productData) {
                $respond = array('respond' => true, 'status' => 200, 'message' => 'Succesfully Retrieve Product Data', 'Product' => $productData);
            } else {
                $respond = array('respond' => false, 'status' => 404, 'message' => 'Failed To Retrieve Product Data. Product ID Not Found');
            }
        } elseif (isset($data['draw'])) {
            $productData = $product->getAllProductDataTable($data);
            $respond = array(
                'respond'       => true,
                'status'        => 200,
                'message'       => 'Succesfully Retrieve Category Data',
                'Product'       => $productData,
            );
        } else {
            $productData = $product->orderBy('updated_at', 'desc')->findAll();
            $respond = array('respond' => true, 'status' => 200, 'message' => 'Succesfully Retrieve Product Data', 'Product' => $productData);
        }
        return $this->sendRespond($respond);
    }
}
