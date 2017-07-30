<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
	/**
     * Data to create
     *
     * @var array
     */
    public $data = [
	    [
            'fname' => 'Michael',
            'lname' => 'James',
            'email' => 'mrjames@andrew.cmu.edu',
            'admin' => 1
        ],
    ];
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		foreach ( $this->data as $user ) {
            User::create($user);
        }

		$conditions = User::getConditions();

		// Create users in each condition
		foreach ( $conditions as $name => $conditionId ) {
			factory( User::class, 2 )->create( [ 'condition' => $conditionId ] );
		}
	}
}
