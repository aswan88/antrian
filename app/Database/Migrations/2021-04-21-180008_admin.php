<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'admin_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'username' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'password' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'  	     => true,
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'  	     => true,
			],
		]);
		$this->forge->addKey('admin_id', true);
		$this->forge->createTable('admin');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('admin');
	}
}
