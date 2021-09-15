<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminAuthenticationModel extends Model
{
    protected $table      = 'admin_authentication';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id', 'token', 'expired_at'];
    protected $beforeInsert  = ['beforeInsert'];
    
    protected function beforeInsert(array $data)
    {
        helper('text');
        $data['data']['token'] = random_string('alnum', 250);
        $data['data']['expired_at'] = date("Y-m-d H:i:s", strtotime("+2 week"));
        return $data;
    }

    public function getAuthID(array $data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('admin_authentication');
        $auth = $builder->select('id, expired_at')->where('user_id', $data['user_id'])->where('token', $data['token'])->get();
        $authData = $auth->getRowArray();
        if ($authData == null) {
            return array('respond' => false, 'status' => 401, 'message' => 'Unauthorized. Please Provide Valid Credentials');
        } else if ($authData['expired_at'] < date('Y-m-d H:i:s')) {
            return array('respond' => false, 'status' => 401, 'message' => 'Unauthorized. Your Session Has Expired');
        } else {
            return array('respond' => true, 'status' => 200, 'id' => $authData['id']);
        }
    }
}
