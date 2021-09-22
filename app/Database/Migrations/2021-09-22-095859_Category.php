<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
    public function up()
    {
        // create field for table category
        $this->forge->addField([
			'id'    => [
				'type'           => 'SMALLINT',
				'constraint'     => '6',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'name'  => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
			'description'        => [
				'type'           => 'TEXT',
			],
			'image'  => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'created_at'  => [
				'type'           => 'TIMESTAMP',
				'default'           => [
                    'value'             => 'CURRENT_TIMESTAMP',
                    'string'            => false,
                ],
			],
			'updated_at'  => [
				'type'           => 'TIMESTAMP',
                'default'           =>[
                    'value'             =>'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                    'string'            => false,
                ]
			],
			'deleted_at'  => [
				'type'           => 'TIMESTAMP',
				'null'           => true,
			],
		]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('name');
		$this->forge->createTable('category', TRUE);
    }

    public function down()
    {
        // drop table category
        $this->forge->dropTable('category');
    }
}
