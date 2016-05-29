<?php

return [

	/*
		|--------------------------------------------------------------------------
		| oAuth Config
		|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => '\\OAuth\\Common\\Storage\\Session',

	/**
	 * Consumers
	 */
	'consumers' => [

		'Facebook' => [
			'client_id' => '',
			'client_secret' => '',
			'scope' => [],
		],

		'Google' => [
			'client_id' => '621819356354-vvgtf8k94m69u2dijmo2u98gmc5de3a0.apps.googleusercontent.com',
			'client_secret' => 'K5pyKrr-UYgotaOrLmR9NfUz',
			'scope' => ['userinfo_email', 'userinfo_profile'],
		],

	],

];
