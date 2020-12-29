<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'bigint',
				'primary'       => true,
				'auto_increment' => true,
			],
			'username'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
				'unique'       => true,
			],
			'password'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
			],
			'active' => [
				'type'           => 'VARCHAR',
				'constraint'     => '1',
			],
		]);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
