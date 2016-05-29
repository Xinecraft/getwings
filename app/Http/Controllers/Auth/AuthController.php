<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Registration & Login Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles the registration of new users, as well as the
		    | authentication of existing users. By default, this controller uses
		    | a simple trait to add these behaviors. Why don't you explore it?
		    |
	*/

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data) {
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'api_token' => str_random(60),
		]);
	}

	/**
	 * Let users login using google oauth
	 *
	 * @param  Request
	 * @return mixed
	 */
	public function loginWithGoogle(Request $request) {
		// get data from request
		$code = $request->get('code');

		// get google service
		$googleService = \OAuth::consumer('Google');

		// check if code is valid

		// if code is provided get user data and sign in
		if (!is_null($code)) {
			// This was a callback request from google, get the token
			$token = $googleService->requestAccessToken($code);

			// Send a request with it
			$result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

			$message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
			echo $message . "<br/>";

			// Get instance of user if already registered
			$regUser = User::whereGoogleId($result['id'])->first();

			// If this google user visiting first time.
			if ($regUser == null) {
				$user = User::create([
					'name' => $result['name'],
					'email' => $result['email'],
					'password' => null,
					'api_token' => strtolower(str_random(60)),
					'google_id' => $result['id'],
				]);
				\Auth::login($user);
				return redirect()->intended('home');
			}
			// If user already logged in before.
			else {
				\Auth::login($regUser);
				return redirect()->intended('home');
			}

		}
		// if not ask for permission first
		else {
			// get googleService authorization
			$url = $googleService->getAuthorizationUri();

			// return to google login url
			return redirect((string) $url);
		}
	}

}
