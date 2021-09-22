<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email', 'password','phone','address'];
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
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
        $user = $builder->select('id, password')->where('email', $data['email'])->where('deleted_at', null)->get();
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
