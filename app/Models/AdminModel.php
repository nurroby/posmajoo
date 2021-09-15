<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'username', 'password'];
    protected $deletedField  = 'deleted_at';
    protected $beforeInsert  = ['beforeInsert'];
    protected $beforeUpdate  = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $request = \Config\Services::request();
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function auth(array $data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('admin');
        $user = $builder->select('id, password')->where('username', $data['username'])->where('deleted_at', null)->get();
        $userData = $user->getRowArray();
        if ($userData == null) {
            return false;
        }
        if (hash_equals($userData['password'], crypt($data['password'], $userData['password']))) {
            return array('respond' => true, 'status' => 200, 'id' => $userData['id']);
        } else {
            return array('respond' => false, 'status' => 400, 'message' => 'Username Or Password Combination Does Not Exist', 'status_message' => 'Authorization Error');
        }
    }
}
