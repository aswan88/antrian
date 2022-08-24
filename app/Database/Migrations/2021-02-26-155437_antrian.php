<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Antrian extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'antrian_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'no_antrian'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'dokter_id'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'pasien_id'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'status_antrian'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],

			'waktu_proses' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],

			'waktu_selesai' => [
				'type'           => 'DATETIME',
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
		$this->forge->addKey('antrian_id', true);
		$this->forge->createTable('antrian');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('antrian');
	}
}
