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
	 * @var int valid value is 11
	 */
	private $amka_length;
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

		// initialize ----------------------------------------------------------
		$this->amka_length = 11;


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

	/**
	 * @param string $amka
	 * @return bool
	 */
	public function validateAMKA($amka) {

		// validate number of characters
		if(strlen($amka) != $this->amka_length) {
			$this->last_error = 'fatal_error_invalid_number_of_characters';
			return false;
		}

		// allow only digits
		if(preg_match("/[^\pN]/u", $amka)) {
			$this->last_error = 'fatal_error_does_not_consisted_of_digits';
			return false;
		}

		return true;

	}



}