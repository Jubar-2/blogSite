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
            "license" => [
                'type'           => 'BOOL',
                'default'        => false
            ],
        ]);
        $this->forge->addKey('userid');
        $this->forge->createTable('recoveryLicense');
    }

    public function down()
    {
        $this->forge->dropTable('recoveryLicense');
    }
}
