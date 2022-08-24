<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dokter extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'dokter_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'SIP'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'nama_dokter' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'spesialisasi' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'jam_buka' => [
				'type'           => 'TIME',
				'constraint'     => true,
			],
			'jam_tutup' => [
				'type'           => 'TIME',
				'constraint'     => true,
			],
			'kd_antrian' => [
				'type'           => 'VARCHAR',
				'constraint'     => '10',
			],
			'status' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],
			'hari_praktek' => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
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
		$this->forge->addKey('dokter_id', true);
		$this->forge->createTable('dokter');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('dokter');
	}
}
