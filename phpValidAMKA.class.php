<?php

/**
 * Class phpValidAMKA
 *
 * a simple php class to validate Greek Social Security Number (AMKA)
 * https://github.com/pontikis/php_valid_AMKA
 *
 * @author     Christos Pontikis http://pontikis.net
 * @copyright  Christos Pontikis
 * @license    MIT http://opensource.org/licenses/MIT
 * @version    0.7.0 (03 Sep 2017)
 *
 */
class phpValidAMKA {
	/**
	 * @var null|string one of 'male'. 'female'
	 */
	private $gender;
	/**
	 * @var null|string DDMMYY
	 */
	private $date_of_birth;
	/**
	 * @var null|integer (a positive integer)
	 */
	private $date_of_birth_years_ago;

	private $last_error;

	public function __construct(array $options) {

		// options -------------------------------------------------------------
		$defaults = array(
			'gender' => null,
			'date_of_birth' => null,
			'date_of_birth_years_ago' => 120
		);

		$opt = array_merge($defaults, $options);

		// optional
		$this->gender = $opt['gender'];
		$this->date_of_birth = $opt['date_of_birth'];
		$this->date_of_birth_years_ago = $opt['date_of_birth_years_ago'];

		// error ---------------------------------------------------------------
		$this->last_error = null;

	}

	// public functions - getters ----------------------------------------------

	public function getLastError() {
		return $this->last_error;
	}



	// public functions - setters ----------------------------------------------

	/**
	 * Set option
	 *
	 * @param $opt
	 * @param $val
	 */
	public function setOption($opt, $val) {
		$this->$opt = $val;
	}

	// public functions - main methods -----------------------------------------
	public function validateAMKA($amka) {


		return true;

	}



}