<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CallSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
    }
}
