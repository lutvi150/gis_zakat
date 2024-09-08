<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableDokumentasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dokumentasi' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsignned' => true,
                'auto_increment' => true,
            ],
            'id_bantuan' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'dokumentasi' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_dokumentasi', true);
        $this->forge->createTable("table_dokumentasi");
    }

    public function down()
    {
        $this->forge->dropTable("table_dokumentasi");
    }
}
