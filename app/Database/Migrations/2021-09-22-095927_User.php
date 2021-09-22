<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        // create field for table user
        $this->forge->addField([
			'id'    => [
				'type'           => 'INT',
				'constraint'     => '11',
				'unsigned'       => true,
				'auto_increment' => true
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
			'address'  => [
				'type'           => 'TEXT',
			],
			'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
			'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
			'deleted_at'  => [
				'type'           => 'TIMESTAMP',
				'null'           => true,
			],
		]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['email','phone']);
		$this->forge->createTable('user', TRUE);
    }

    public function down()
    {
        // drop table user
        $this->forge->dropTable('user');
    }
}
