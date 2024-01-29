<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Otp extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userid' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            "user_Name" => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => false,
                'unique'         => true,
            ],
            "otp" => [
                'type'           => 'INT',
                'constraint'     => 50,
                'default'        => null
            ],
        ]);
        $this->forge->addKey('userid');
        $this->forge->createTable('verifyEmail');
    }

    public function down()
    {
        $this->forge->dropTable('verifyEmail');
    }
}
