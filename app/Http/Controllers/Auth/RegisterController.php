<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
	protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct ()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator (array $data)
	{
		$message = array(
			'dob.required' => 'The date of birth field is required.',
			'dob.date' => 'The sex field should be valid.',
			'gender.required' => 'The sex field is required.',

		);
		return Validator::make($data, [
			'first_name' => ['required', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
			'phone' => ['required', 'string', 'max:20'],
			'gender' => ['required', 'string', 'max:20'],
			'dob' => ['required', 'date'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8'],
		], $message);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param array $data
	 * @return User
	 */
	protected function create (array $data)
	{

		if (!empty($data['click_to_verify']) && $data['click_to_verify'] == 'on') {
			$data['click_to_verify'] = 1;
		} else {
			$data['click_to_verify'] = 0;
		}
		return User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'name' => $data['first_name'] . ' ' . $data['last_name'],
			'phone' => $data['phone'],
			'gender' => $data['gender'],
			'dob' => $data['dob'],
			'gender_info' => $data['gender_info'],
			'click_to_verify' => $data['click_to_verify'] ?? '0',
			'role_id' => 2,
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'about' => $data['first_name'],
		]);
	}

	/**
	 * The user has been authenticated.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param mixed $user
	 * @return mixed
	 */
	protected function registered (Request $request, $user)
	{
		if (!empty($user->first_name)) {
			$this->redirectTo = '/tailor_plan';
		}
	}
}
