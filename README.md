# php_valid_AMKA

a simple php class to validate Greek Social Security Number (AMKA)

Copyright Christos Pontikis http://www.pontikis.net

Project page https://github.com/pontikis/php_valid_AMKA

License [MIT](https://github.com/pontikis/php_valid_AMKA/blob/master/LICENSE)


## About

AMKA (https://www.amka.gr/) is the Greek Social Security Number.

According to http://www.ggka.gr/er_amka_main1.htm (frameset http://www.ggka.gr/er_amka.htm):

> The Greek Social Security Number (AMKA) is an 11-digit numeric string. 
>
> It is consisted of 3 parts:
> * the first part is 6-digit and indicates the date of birth (DDMMYY)
> * the second part is 4-digit and indicates the serial number in the National Registry within the same date of birth. It is an odd number for men and even number for women
> * the third part is 1 digit (control character).

REMARK: ``DDMMYY`` is ``dmy`` in php (see http://php.net/manual/en/datetime.createfromformat.php)

* ``d`` Day of the month, 2 digits with leading zeros
* ``m`` Numeric representation of a month, with leading zeros
* ``y`` A two digit representation of a year (which is assumed to be in the range 1970-2069, inclusive)

Probably, "two digit representation of a year" was not a good idea. Moreover, it is a reason why this class does not check if first 6 digits represent a future date (just exactly because this is happens for all AMKA before 1970).

## PHP version

(PHP 5 >= 5.3.0, PHP 7)

## Files
 
1. ``phpValidAMKA.class.php`` php class


## Documentation

See ``docs/doxygen/html`` for html documentation of ``phpValidAMKA`` class. 

## How to use


```php
require_once '/path/to/phpValidAMKA.class.php';

$options = array(
	'gender' => 'male', // optional
	'date_of_birth' => '230384' // (March 23, 1984) optional
);

$valid_amka = new phpValidAMKA($options);

if($valid_amka->getLastError()) {
	switch($valid_amka->getLastError()) {
		case 'invalid_parameter_gender':
			echo 'Invalid parameter [gender] is passed. AMKA cannot be validated';
			break;
		case 'invalid_parameter_date_of_birth':
			echo 'Invalid parameter [date of birth] is passed. AMKA cannot be validated';
			break;
	}

} else {

	$valid_amka->validateAMKA($social_security_number);

	if($valid_amka->getLastError()) {
		switch($valid_amka->getLastError()) {
			case 'fatal_error_invalid_number_of_characters':
				echo 'Given AMKA is not consisted of 11 digits';
				break;
			case 'fatal_error_does_not_consisted_of_digits':
				echo 'Given AMKA contains invalid characters. Only digits are permitted';
				break;
			case 'error_amka_first_part_invalid_date_of_birth':
				echo 'Date of birth declared by given AMKA is invalid';
				break;

			// if $option['date_of_birth'] has been given	
			case 'error_amka_first_part_given_date_of_birth_does_not_match':
				echo 'Patient date of birth is different than date of birth declared by AMKA';
				break;

			// if $option['gender'] has been given
			case 'error_amka_second_part_even_in_male':
				echo 'Patient gender is male while female is declared by given AMKA';
				break;
			case 'error_amka_second_part_odd_in_female':
				echo 'Patient gender is female while male is declared by given AMKA';
				break;
		}
	}
}
```