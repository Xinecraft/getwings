<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password')->nullable();
			$table->string('google_id')->nullable();
			$table->string('api_token', 60)->unique();
			$table->boolean('online')->default(false);
			$table->double('lng')->nullable();
			$table->double('lat')->nullable();
			$table->string('location')->nullable();
			$table->string('country')->nullable();
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users');
	}
}
