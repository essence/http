<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license MIT
 */
namespace Essence\Http;

use Exception as NativeException;



/**
 *	An HTTP related exception.
 */
class Exception extends NativeException {

	/**
	 *	Error URL.
	 *
	 *	@var string
	 */
	protected $_url = '';



	/**
	 *	Messages corresponding to HTTP codes.
	 *	Thanks to Hinnerk Brügmann
	 *	(http://www.multiasking.com/2011/05/http-error-codes-as-php-array/).
	 *
	 *	@var array
	 */
	protected $_messages = [

		// Client errors
		400 => 'Bad request',
		401 => 'Unauthorized',
		402 => 'Payment required',
		403 => 'Forbidden',
		404 => 'Not found',
		405 => 'Method not allowed',
		406 => 'Not acceptable',
		407 => 'Proxy authentication required',
		408 => 'Request timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length required',
		412 => 'Precondition failed',
		413 => 'Request entity too large',
		414 => 'Request-URL too long',
		415 => 'Unsupported media type',
		416 => 'Requested range not satisfiable',
		417 => 'Expectation failed',

		// Server errors
		500 => 'Internal server error',
		501 => 'Not implemented',
		502 => 'Bad gateway',
		503 => 'Service unavailable',
		504 => 'Gateway timeout',
		505 => 'HTTP version not supported'
	];



	/**
	 *	Constructs the exception with the given HTTP status code, and the URL
	 *	that triggered the error.
	 *
	 *	@param string $url URL.
	 *	@param int $code HTTP status code.
	 *	@param NativeException $Previous Previous exception.
	 */
	public function __construct($url, $code = 0, NativeException $Previous = null) {
		$this->_url = $url;

		parent::__construct(
			isset($this->_messages[$code])
				? $this->_messages[$code]
				: 'HTTP error',
			$code,
			$Previous
		);
	}



	/**
	 *	Returns the URL that triggered the error.
	 *
	 *	@return string URL.
	 */
	public function url() {
		return $this->_url;
	}
}
