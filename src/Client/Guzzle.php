<?php

namespace Essence\Http\Client;

use Essence\Http\Client;
use Essence\Http\Exception;



/**
 *	Handles HTTP related operations through Guzzle.
 */
class Guzzle implements Client {

	private $options;
	
	private $client;

	public function __construct($base_uri='http://example.com', $timeout=2.0) {
		$this->client = new \GuzzleHttp\Client([
			'base_uri' => $base_uri,
			'timeout'  => $timeout,
		]);
		
		$this->options = [];
	}

	public function setUserAgent($agent) {
		$this->options = [
			'User-Agent' => $agent
		];
	}

	public function get($url) {
		try {
			$response = $this->client->request('GET', $url, $this->options);
			
		} catch (\GuzzleHttp\Exception\RequestException $e) {
			throw new Exception($url, $e->getResponse()->getStatusCode());
		}

		return (string)$response->getBody();
	}
}
