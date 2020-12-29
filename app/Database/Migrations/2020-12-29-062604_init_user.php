<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitUser extends Migration
{
	public function up()
	{
		$data = [
			'username' => 'admin',
			'password'    => password_hash('admin', PASSWORD_BCRYPT),
			'active' => 'Y'
		];

		// Simple Queries
		$this->db->table('users')->insert($data);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
