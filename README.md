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

