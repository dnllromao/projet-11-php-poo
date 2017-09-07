<?php

	class Form {
		private $methodUrl = 'etape-3.php';
		private $inputs = [];

		public function printForm() {
			return '<form method="post" action="'.$this->methodUrl.'">'.$this->printInputs().'</form>';
		}

		public function createInput($type, $name) {
			$input = '<input type="'.$type.'" name="'.$name.'"></input>';
			array_push($this->inputs, $input);
		}

		public function createSelect($options) {
			$select = '<select>';
			foreach ($options as $key => $value) {
				$select .='<option>'.$value.'</option>';
			}
			$select .= '</select>';
			array_push($this->inputs, $select);
		}

		public function createBtnSubmit($value) {
			$button = '<button type="submit">'.$value.'</button>';
			array_push($this->inputs, $button);
		}

		public function createTextarea() {
			$texarea = '<textarea></textarea>';
			array_push($this->inputs, $texarea);
		}

		public function createRadioBtn($value) {
			$texarea = '<input type="radio" value="'.$value.'">'.$value;
			array_push($this->inputs, $texarea);
		}

		public function createCheckbox($value) {
			$texarea = '<input type="checkbox" value="'.$value.'">'.$value;
			array_push($this->inputs, $texarea);
		}

		private function printInputs() {
			$html = '';
			foreach ($this->inputs as $key => $value) {
				$html .= $value.'<br/>';
			}

			return $html;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Php POO - etape 1</title>
</head>
<body>
	<?php 

		$form = new Form();
		$form->createInput('number', 'nom');
		$form->createSelect(['a', 'b', 'c']);
		$form->createBtnSubmit('Submit');
		$form->createTextarea();
		$form->createRadioBtn('male');
		$form->createCheckbox('femme');
		echo $form->printForm();
	?>
</body>
</html>
