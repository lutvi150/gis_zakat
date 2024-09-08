<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "nama" => "Admin",
                "email" => "admin@gmail.com",
                "password" => hash("sha256", "admin"),
                "role" => "admin",
                "last_login" => date("Y-m-d H:i:s"),
                "created_at" => date("Y-m-d H:i:s"),
            ],
        ];
        $this->db->table("table_user")->insertBatch($data);
    }
}
