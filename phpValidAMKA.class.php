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

	private $last_error;

	/**
	 * phpValidAMKA constructor.
	 * @param array $options
	 */
	public function __construct($options = array()) {

		// initialize ----------------------------------------------------------
		$this->amka_length = 11;


		// options -------------------------------------------------------------
		$defaults = array(
			'gender' => null,
			'date_of_birth' => null
		);

		$opt = array_merge($defaults, $options);

		// optional
		$this->gender = $opt['gender'];
		$this->date_of_birth = $opt['date_of_birth'];

		// error ---------------------------------------------------------------
		$this->last_error = null;

		if($this->gender) {
			if(!in_array($this->gender, array('male', 'female'))) {
				$this->last_error = 'invalid_parameter_gender';
			}
		}

		if($this->date_of_birth) {
			if(!$this->_isValidDateString($this->date_of_birth)) {
				$this->last_error = 'invalid_parameter_date_of_birth';
			}
		}

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

		// check first part (date of birth)
		if($this->date_of_birth) {
			if($this->date_of_birth != (substr($amka, 0, 6))) {
				$this->last_error = 'error_amka_first_part_given_date_of_birth_does_not_match';
				return false;
			}
		} else {
			if(!$this->_isValidDateString(substr($amka, 0, 6))) {
				$this->last_error = 'error_amka_first_part_invalid_date_of_birth';
				return false;
			}
		}

		// check second part
		if($this->gender) {
			switch($this->gender) {
				case 'male':
					if(!$this->_is_odd(substr($amka, 6, 4))) {
						$this->last_error = 'error_amka_second_part_even_in_male';
						return false;
					}
					break;
				case 'female':
					if($this->_is_odd(substr($amka, 6, 4))) {
						$this->last_error = 'error_amka_second_part_odd_in_female';
						return false;
					}
					break;
			}
		}

		return true;

	}

	// private functions -------------------------------------------------------


	/**
	 * Check if a string is a valid date(time)
	 *
	 * DateTime::createFromFormat requires PHP >= 5.3
	 *
	 * @param string $str_dt
	 * @return bool|int
	 */
	private function _isValidDateString($str_dt) {
		$date = DateTime::createFromFormat('dmy', $str_dt, new DateTimeZone('Europe/Athens'));
		$a_err = DateTime::getLastErrors(); // compatibility with php 5.3
		return $date && $a_err['warning_count'] == 0 && $a_err['error_count'] == 0;
	}

	/**
	 * @param $x
	 * @return bool
	 */
	private function _is_odd($x) {
		return ($x % 2 === 0) ? false : true;
	}

}


