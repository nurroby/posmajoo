<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'category';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name','description','image'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $beforeInsert  = ['beforeInsert'];
    protected $beforeUpdate  = ['beforeUpdate'];
        
    protected function beforeInsert(array $data)
    {
        $data['data']['name'] = strtoupper($data['data']['name']);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data['data']['name'] = strtoupper($data['data']['name']);
        return $data;
    }

    public function getAllCategoryDataTable($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('category c');
        $builderTotal = $db->table('category c');
        $builderFiltered = $db->table('category c');
        $bundle = $builder->select('*');

        $bundle->where('c.deleted_at', null);
        $builderFiltered->where('c.deleted_at', null);

        if ($data['search']['value'] != '') {
            $bundle->Like('c.name', $data['search']['value']);

            $builderFiltered->Like('c.name', $data['search']['value']);
        }

        if ($data['length'] != -1) {
            $bundle->limit($data['length'], !isset($data['start']) ? 0 : intval($data['start']));
        }

        if ($data['order']) {
            if ($data['order'][0]['column'] == 1) {
                $bundle->orderBy('c.name', $data['order'][0]['dir']);
            }
        }

        return array(
            'start' => $data['start'],
            'draw' => $data['draw'],
            'recordsTotal' => $builderTotal->countAllResults(),
            'recordsFiltered' => $builderFiltered->countAllResults(),
            'data' => $bundle->get()->getResultArray()
        );
    }
    
}
