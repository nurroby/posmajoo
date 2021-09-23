<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $this->call('AdminSeeder');
        $this->call('CategorySeeder');
        $this->call('ProductSeeder');
        $this->call('UserSeeder');
        $this->call('OrderSeeder');
        $this->call('OrderDetailSeeder');
    }
} 