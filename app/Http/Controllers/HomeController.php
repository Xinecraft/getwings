<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('home');
	}

	/**
	 * Save user location to DB
	 */
	public function setLocation(Request $request) {

		$response = \GoogleMaps::load('geocoding')
			->setParam(['address' => $request->location])
			->get();

		$result = (json_decode($response));
		$result = $result->results;
		$formatted_address = $result[0]->formatted_address;
		$lat = $result[0]->geometry->location->lat;
		$long = $result[0]->geometry->location->lng;

		$user = \Auth::user();
		$user->location = $formatted_address;
		$user->lat = $lat;
		$user->lng = $long;
		$user->save();
		return back();
	}
}
