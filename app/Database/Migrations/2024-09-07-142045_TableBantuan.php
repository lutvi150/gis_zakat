<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableBantuan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bantuan' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsignned' => true,
                'auto_increment' => true,
            ],
            'id_zakat' => [
                'type' => 'int',
                'constraint' => 5
            ],
            'peruntukan' => [
                'type' => 'text',
            ],
            'jenis_bantuan' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'total_bantuan' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'penerima_bantuan' => [
                'type' => 'varchar',
                'constraint' => 500,
            ],
            'jenis_identitas' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'nomor_identitas' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'nama_penerima' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'latitude' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'longitude' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_bantuan', true);
        $this->forge->createTable("table_bantuan");
    }

    public function down()
    {
        $this->forge->dropTable("table_bantuan");
    }
}
