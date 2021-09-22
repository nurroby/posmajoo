<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
{
    public function up()
    {
        // create field for table product
        $this->forge->addField([
			'id'    => [
				'type'           => 'INT',
				'constraint'     => '11',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'category_id'  => [
				'type'           => 'SMALLINT',
				'constraint'     => '6'
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
		$this->forge->createTable('product', TRUE);
    }

    public function down()
    {
        // drop table product
        $this->forge->dropTable('product');
    }
}
