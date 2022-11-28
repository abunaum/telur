<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Data extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'            => ['type' => 'varchar', 'constraint' => 255],
            'stok'         => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'harga'         => ['type' => 'int', 'constraint' => 11, 'default' => 1000],
            'minorder'         => ['type' => 'int', 'constraint' => 11, 'default' => 1],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('produk', true);

        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'produk_id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'user_id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'kode'            => ['type' => 'varchar', 'constraint' => 255],
            'jumlah'         => ['type' => 'int', 'constraint' => 11, 'default' => 1],
            'total_harga'         => ['type' => 'int', 'constraint' => 11],
            'status'            => ['type' => 'int', 'constraint' => 11],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['produk_id', 'user_id']);

        $this->forge->addForeignKey('produk_id', 'produk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('transaksi', true);
    }

    public function down()
    {
        if ($this->db->DBDriver !== 'SQLite3') { // @phpstan-ignore-line
            $this->forge->dropForeignKey('transaksi', 'transaksi_produk_id_foreign');
            $this->forge->dropForeignKey('transaksi', 'transaksi_user_id_foreign');
        }
        $this->forge->dropTable('produk', true);
    }
}
