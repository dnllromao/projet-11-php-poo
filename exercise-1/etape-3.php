<?php 

	class Validator {

		static function isString($text) {
			return (is_string($text))? true: false;
		}

		static function isInteger($text) {

			$var = ;

			return (!filter_var($text, FILTER_VALIDATE_INT))? 'false': 'true';
		}

		static function isFloat($text) {
			return (!filter_var($text, FILTER_VALIDATE_FLOAT))? false: true;
		}
	}



	echo Validator::isString($_POST['nom']);
	echo Validator::isInteger($_POST['nom']);



