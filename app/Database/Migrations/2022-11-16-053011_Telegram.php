<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Telegram extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'tele_id'            => ['type' => 'varchar', 'constraint' => 255],
            'kode'            => ['type' => 'varchar', 'constraint' => 255],
            'status'            => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['user_id']);

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('telegram', true);
    }

    public function down()
    {
        if ($this->db->DBDriver !== 'SQLite3') { // @phpstan-ignore-line
            $this->forge->dropForeignKey('telegram', 'telegram_user_id_foreign');
        }
        $this->forge->dropTable('telegram', true);
    }
}
