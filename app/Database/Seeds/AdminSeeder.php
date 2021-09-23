<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // init the model
        $model = model('AdminModel');
        
        // insert model w/ value
        $model->insert([
            'username'  => 'admin',
            'password'  => 'password',
            'name'      => 'admin',
            'email'     => 'admin@test.com',
            'phone'     => '081000000000',
        ]);
    }
}
