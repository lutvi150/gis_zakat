<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableZakat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_zakat' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsignned' => true,
                'auto_increment' => true,
            ],
            'keterangan' => [
                'type' => 'text',
            ],
            'status' => [
                'type' => 'varchar',
                'constraint' => 5,
            ],
            'total' => [
                'type' => 'bigint',
                'constraint' => 20,
            ],
            'saldo_akhir' => [
                'type' => 'bigint',
                'constraint' => 20,
            ],
            'tanggal_transaksi' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_zakat', true);
        $this->forge->createTable("table_zakat");
    }

    public function down()
    {
        $this->forge->dropTable("table_zakat");
    }
}
