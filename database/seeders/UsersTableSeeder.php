<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('users')->insert([
			[
				'username' => 'test@test.com',
				'password' => bcrypt('abc123456'),
				'created_at' => now()
			],
			[
				'username' => 'test2@test.com',
				'password' => bcrypt('abc123456'),
				'created_at' => now()
			],
			[
				'username' => 'test3@test.com',
				'password' => bcrypt('abc123456'),
				'created_at' => now()
			]
		]);
	}
}
