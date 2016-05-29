<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller {
	function __construct() {
		$this->middleware('auth:api');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return "Getwings API v1";
	}

	public function whoami() {
		$user = \Auth::guard('api')->user();

		return [
			'full_name' => $user->name,
			'email' => $user->email,
			'address' => $user->location,
			'joined_on' => $user->created_at,
		];
	}

	/**
	 * Get list of all nearby Users preferring online users first.
	 */
	public function getNeighbours() {
		$user = \Auth::guard('api')->user();

		$lat = $user->lat;
		$lng = $user->lng;
		$query = \DB::select("SELECT id,name,online,location, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM users HAVING distance < 200 ORDER BY distance ASC,online DESC LIMIT 0 , 20;");

		return array_map(function ($q) {
			return [
				'id' => $q->id,
				'full_name' => $q->name,
				'address' => $q->location,
				'distance' => $q->distance,
				'units' => 'kilometers',
				'is_online' => (bool) $q->online,
			];
		}, $query);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
