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
            'password'  => '$2y$10$Dxn/sfyga8QqaoWEeDr1eOfMRp3FA267C944rs6L6522V22m6IHSS',
            'name'      => 'admin',
            'email'     => 'admin@test.com',
            'phone'     => '081000000000',
        ]);
    }
}
