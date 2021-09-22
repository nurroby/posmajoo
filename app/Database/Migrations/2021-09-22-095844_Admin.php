<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        // create field for table admin
        $this->forge->addField([
			'id'    => [
				'type'           => 'INT',
				'constraint'     => '11',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'username'  => [
				'type'           => 'VARCHAR',
				'constraint'     => '30'
			],
			'password'    => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'name'  => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],
			'phone'  => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
			],
			'email'  => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
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
        $this->forge->addUniqueKey(['username', 'email','phone']);
		$this->forge->createTable('admin', TRUE);
    }

    public function down()
    {
        // drop table admin
        $this->forge->dropTable('admin');
    }
}
