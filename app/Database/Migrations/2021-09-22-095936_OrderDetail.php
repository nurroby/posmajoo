<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderDetail extends Migration
{
    public function up()
    {
        // create field for table order_detail
        $this->forge->addField([
			'id'    => [
				'type'           => 'INT',
				'constraint'     => '11',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'order_id'  => [
				'type'           => 'INT',
				'constraint'     => '11',
			],
			'product_id'  => [
				'type'           => 'INT',
				'constraint'     => '11',
			],
			'price'  => [
				'type'           => 'BIGINT',
				'constraint'     => '20',
			],
			'quantity'  => [
				'type'           => 'SMALLINT',
				'constraint'     => '6',
			],
			'total'  => [
				'type'           => 'BIGINT',
				'constraint'     => '20',
			],
			'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
			'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
			'deleted_at'  => [
				'type'           => 'TIMESTAMP',
				'null'           => true,
			],
		]);
        $this->forge->addPrimaryKey('id');
		$this->forge->createTable('order_detail', TRUE);
    }

    public function down()
    {
        // drop table order_detail
        $this->forge->dropTable('order_detail');
    }
}
