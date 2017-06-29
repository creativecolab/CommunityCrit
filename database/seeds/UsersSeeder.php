<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$conditions = User::getConditions();

		// Create users in each condition
		foreach ( $conditions as $name => $conditionId ) {
			factory( User::class, 2 )->create( [ 'condition' => $conditionId ] );
		}
	}
}
