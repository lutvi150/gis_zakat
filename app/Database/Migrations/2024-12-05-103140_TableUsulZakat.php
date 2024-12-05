<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableUsulZakat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_usul' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsignned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'peruntukan' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'jenis_kelamin' => [
                'type' => 'varchar',
                'constraint' => 5,
            ],
            'jenis_identitas' => [
                'type' => 'varchar',
                'constraint' => 10,
            ],
            'nomor_identitas' => [
                'type' => 'varchar',
                'constraint' => 20,
            ],
            'kecamatan' => [
                'type' => 'varchar',
                'constraint' => 20,
            ],
            'desa' => [
                'type' => 'varchar',
                'constraint' => 20,
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_usul', true);
        $this->forge->createTable("table_usul_zakat");
    }

    public function down()
    {
        $this->forge->dropTable("table_usul_zakat");
    }
}
