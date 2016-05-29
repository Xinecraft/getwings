<?php

return [

	/*
		    |--------------------------------------------------------------------------
		    | Third Party Services
		    |--------------------------------------------------------------------------
		    |
		    | This file is for storing the credentials for third party services such
		    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
		    | default location for this type of information, allowing packages
		    | to have a conventional place to find your various credentials.
		    |
	*/

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
	],

	'ses' => [
		'key' => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => 'us-east-1',
	],

	'sparkpost' => [
		'secret' => env('SPARKPOST_SECRET'),
	],

	'stripe' => [
		'model' => App\User::class,
		'key' => env('STRIPE_KEY'),
		'secret' => env('STRIPE_SECRET'),
	],
	'google' => [
		'client_id' => '621819356354-vvgtf8k94m69u2dijmo2u98gmc5de3a0.apps.googleusercontent.com',
		'client_secret' => 'K5pyKrr-UYgotaOrLmR9NfUz',
		'redirect' => 'http://getwings.app/google/login',
	],

];
