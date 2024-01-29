<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            "fast_name" => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            "Last_name" => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => null,
            ],
            "userName" => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'unique' => true,
            ],
            "email" => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => false,
                'unique' => true,
            ],
            "position" => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => null,
            ],
            'birthOfDate' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => false,
            ],
            'profilePicture' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'password',
                'delault' => null
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => false,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'district' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'division' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => false,
            ],

            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => Time::now('asia/Dhaka', 'en_US')
            ],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
