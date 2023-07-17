<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToTableNews extends Migration
{
    public function up()
    {
        $fields = [
            'lead' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'=>false,
            ],
            'closure' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'=>false,
            ],
            'author'=> [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null'=>false,
            ],
            'date'=> [
                'type' => 'DATE',
                'null' => false,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'=> true,
            ],
        ];
        $this->forge->addColumn('news', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('news', ['lead', 'closure', 'author', 'date', 'image']);
    }
}
