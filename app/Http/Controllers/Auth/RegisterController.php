<?php

namespace App\Http\Controllers\Auth;

use App\Services\TaskRecommendations\RecommendationService;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/';
    protected $redirectTo = '/overview';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'consent' => $data['consent'] ? 1 : 0,
//	        'condition' => rand(User::CONDITION_MIN, User::CONDITION_MAX), // TODO: Move condition to after survey
            'condition' => 0,
        ]);
    }

	protected function registered( Request $request, $user )
	{
		// Check if user is in a personal condition
		if ( in_array( $user->condition, array_values( User::getConditions( 'personal' ) ) ) ) {
			$recService = resolve( RecommendationService::class );
			$recService->addRecommendations( $user );
		}
	}

    protected function ghostAcc(array $data)
    {
        return User::create([
            'fname' => 'Guest',
            'lname' => \Carbon\Carbon::now()->micro,
            'consent' => $data['consent'] ? 1 : 0,
            'condition' => 0,
        ]);
    }

    /**
     * Handle a registration request for the application.
     * Overrides register in RegistersUsers class
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if ($request->get('guest-submit') == 'guest') {
            event(new Registered($user = $this->ghostAcc($request->all())));
        }
        else {
            $this->validator($request->all())->validate();

            event(new Registered($user = $this->create($request->all())));
        }

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
