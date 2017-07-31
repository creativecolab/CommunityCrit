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
            'lname' => 'Test',
            'email' => 'test@test.com',
            'remember_token' => 'cY63GA0xfW'
        ],
        [
            'fname' => 'Mike',
            'lname' => 'Admin',
            'email' => 'admin@test.com',
            'admin' => 1,
            'remember_token' => 'YwaSQnhZLO'
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

		// $conditions = User::getConditions();

		// // Create users in each condition
		// foreach ( $conditions as $name => $conditionId ) {
		// 	factory( User::class, 2 )->create( [ 'condition' => $conditionId ] );
		// }
	}
}
