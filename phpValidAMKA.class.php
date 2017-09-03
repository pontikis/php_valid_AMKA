<?php

/**
 * Class phpValidAMKA
 *
 * a simple php class to validate Greek Social Security Number (AMKA)
 * https://github.com/pontikis/phpS3Simple
 *
 * @author     Christos Pontikis http://pontikis.net
 * @copyright  Christos Pontikis
 * @license    MIT http://opensource.org/licenses/MIT
 * @version    0.7.0 (03 Sep 2017)
 *
 */
class phpValidAMKA {

	private $ds;
	private $s3_client;
	private $last_error;

	public function __construct(array $options) {

		$this->last_error = null;

	}


	public function getLastError() {
		return $this->last_error;
	}


	public function validateAMKA() {


		return true;

	}




}