<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'order';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['user_id', 'total_price', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $beforeInsert  = ['beforeInsert'];
    protected $beforeUpdate  = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        return $data;
    }

    protected $column_order = array('id', 'name', 'price', 'created_at');
    protected $column_search = array('id', 'name', 'description');
    protected $order = array('created_at' => 'desc');
    protected $db;
    protected $dt;
    /**
     * Datatables Start
     */
    const ORDERABLE = [
        1 => 'created_at',
        2 => 'price',
        3 => 'name',
        4 => 'category_id',
    ];

    public $orderable = ['created_at', 'price', 'name', 'category_id'];
    

    public function getAllProductDataTable($data)
    {
        $db      = \Config\Database::connect();
        $builderTotal = $db->table('product p');
        $builderFiltered = $db->table('product p');
        $builder = $db->table('product p');
        $product = $builder->select('p.id as id, p.category_id as category_id, p.name as name, c.name as category, p.description as description, p.price as price, p.updated_at as updated_at')
            ->join('category c', 'p.category_id = c.id', 'left');

        if ($data['search']['value'] != '') {
            $product->where('(p.name LIKE "%' . $data['search']['value'] . '%" OR p.description LIKE "%' . $data['search']['value'] . '%" AND p.deleted_at  = NULL)');
            $builderFiltered->where('(p.name LIKE "%' . $data['search']['value'] . '%" OR p.description LIKE "%' . $data['search']['value'] . '%" AND p.deleted_at = NULL)');
        }

        $product->where('p.deleted_at', null);
        $builderFiltered->where('p.deleted_at', null);

        if ($data['order']) {
            if ($data['order'][0]['column'] == 3) {
                $product->orderBy('p.name', $data['order'][0]['dir']);
            }
        }

        $product->orderBy('p.updated_at', 'desc');
        $builderFiltered->orderBy('p.updated_at', 'desc');

        if ($data['length'] != -1) {
            $product->limit($data['length'], !isset($data['start']) ? 0 : intval($data['start']));
        }

        $productData = array(
            'start' => $data['start'],
            'draw' => $data['draw'],
            'recordsTotal' => $builderTotal->countAllResults(),
            'recordsFiltered' => $builderFiltered->countAllResults(),
            'data' => $product->get()->getResultArray()
        );
        return $productData;
    }
    /**
     * Datatables End
     */


}
