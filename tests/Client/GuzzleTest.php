<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license MIT
 */

namespace Essence\Http\Client;

use PHPUnit_Framework_TestCase as TestCase;



/**
 *	Test case for Guzzle.
 */
class GuzzleTest extends TestCase {

	public $Guzzle = null;

	public function setUp() {
		$this->Guzzle = new Guzzle();
	}

	public function testGet() {
		$content = $this->Guzzle->get('http://example.com/');
		$this->assertRegExp('/This domain is established to be used/', $content);
	}

	public function testGetUnreachable() {
		$this->setExpectedException('\\Essence\\Http\\Exception');
		$this->Guzzle->get('http://example.com/dfzgdz/czcdcd');
	}
}
