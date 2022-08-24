<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Setting extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'setting_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'dokter_id'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'set_buka' => [
				'type'           => 'TIME',
				'null'           => true,
			],
			'set_tutup' => [
				'type'           => 'TIME',
				'null'           => true,
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
		]);
		$this->forge->addKey('setting_id', true);
		$this->forge->createTable('setting');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('setting');
	}
}
