<?php 

	class Validator {

		static function isString($text) {
			return (is_string($text))? true: false;
		}

		static function isInteger($text) {
			return (is_int($text))? true: false;
		}

		static function isFloat($text) {
			return (is_float($text))? true: false;
		}
	}

	echo Validator::isString('peut-être');

//une chaine de caractère - un entier - un nombre à virgule 

