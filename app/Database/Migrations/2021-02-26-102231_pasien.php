<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pasien extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'pasien_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'email' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
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
		$this->forge->addKey('pasien_id', true);
		$this->forge->createTable('pasien');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('pasien');
	}
}
