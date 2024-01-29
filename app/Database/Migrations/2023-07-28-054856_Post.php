<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'post_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            "userName" => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            "title" => [
                'type' => 'VARCHAR',
                'constraint' => 300,
            ],

            "text" => [
                'type' => 'TEXT',
                'default' => null,
            ],
            "image" => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => null,
            ],
            "comment" => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => Time::now('asia/Dhaka', 'en_US')
            ],
        ]);
        $this->forge->addKey('post_id', true);
        $this->forge->createTable('post');
    }

    public function down()
    {
        $this->forge->dropTable('post');
    }
}
