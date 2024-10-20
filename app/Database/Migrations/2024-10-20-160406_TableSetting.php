<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableSetting extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_setting' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsignned' => true,
                'auto_increment' => true,
            ],
            'jenis_setting' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'value_setting' => [
                'type' => 'text',
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_setting', true);
        $this->forge->createTable("table_setting");
    }

    public function down()
    {
        $this->forge->dropTable("table_setting");
    }
}
