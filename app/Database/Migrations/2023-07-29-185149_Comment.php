<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class Comment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'comment_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            "fullName" => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            "userName" => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],

            "comment" => [
                'type' => 'TEXT',
                'default' => null,
            ],

            "post" => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => Time::now('asia/Dhaka', 'en_US')
            ],
        ]);
        $this->forge->addKey('comment_id', true);
        $this->forge->createTable('comment');
    }

    public function down()
    {
        $this->forge->dropTable('comment');
    }
}
