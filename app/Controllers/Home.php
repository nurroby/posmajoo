<?php

namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Home extends BaseController
{
    public function index()
    {
        $_product   = new ProductModel(); 
        $_category  = new CategoryModel();
        $data=[
            'category'=>$_category->findAll(),
            'product'=>$_product->select('product.id, product.name, product.price, product.description, product.image, category.name as category, product.category_id')
                                ->join('category','category.id = product.category_id','left')
                                ->findAll(),
        ];
        return view('catalog',$data);
    }
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
}
