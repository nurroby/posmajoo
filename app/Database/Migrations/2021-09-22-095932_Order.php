<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        // create field for table order
        $this->forge->addField([
			'id'    => [
				'type'           => 'INT',
				'constraint'     => '11',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'user_id'  => [
				'type'           => 'INT',
				'constraint'     => '11',
			],
			'total_price'  => [
				'type'           => 'BIGINT',
				'constraint'     => '20',
			],
			'status'        => [
				'type'           => 'ENUM',
				'constraint'     => ['requested','waited','processed','finished','rejected','canceled'],
				'default'        => 'requested',
			],
			'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
			'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
			'deleted_at'  => [
				'type'           => 'TIMESTAMP',
				'null'           => true,
			],
		]);
        $this->forge->addPrimaryKey('id');
		$this->forge->createTable('order', TRUE);
    }

    public function down()
    {
        // drop table order
        $this->forge->dropTable('order');
    }
}
