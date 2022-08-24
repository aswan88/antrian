<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RiwayatAntrian extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'riwayat_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'no_antrian'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'pasien_id'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'masuk' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'selesai' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
		]);
		$this->forge->addKey('riwayat_id', true);
		$this->forge->createTable('riwayat_antrian');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('riwayat_antrian');
	}
}
