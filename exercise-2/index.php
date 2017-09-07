<?php 

	class Voiture {

		private $immatriculation;
		private $circulation;
		private $kilometrage;
		private $modele;
		private $marque;
		private $couleur;
		private $poids;
		private $is_reserved = false;
		private $is_comercial = false;
		private $is_used;
		private $pay;
		private $annees;
		private $imagePath;

		public function __construct(array $options) {
			foreach ($options as $key => $option) {
				$method = 'set'.ucfirst($key);
				if(method_exists($this, $method)) {
					$this->$method($option);
				}
			}
		}

		private function setImmatriculation($value) { 
			$this->immatriculation = $value;
			$origin = substr($value, 0, 2);
			switch ($origin) {
				case 'BE':
					$this->pay = 'Belgique';
					break;

				case 'FR':
					$this->pay = 'France';
					break;

				case 'DE':
					$this->pay = 'Allemagne';
					break;

			}
		}
		private function setCirculation($value) { 
			$this->circulation = $value;
			$this->annees = date("Y") - $value;
		}
		public function setKilometrage($value) { 
			$this->kilometrage = $value;
			if($value > 200000) {
				$this->is_used = 'high';
			} else if ($value > 100000) {
				$this->is_used = 'middle';
			} else if ($value < 100000) {
				$this->is_used = 'low';
			}
		}
		private function setModele($value) { 
			$this->modele = $value;
			if($value == 'Ford') {
				$this->is_reserved = true;
			}
		}
		private function setMarque($value) { $this->marque = $value; }
		public function setCouleur($value) { $this->couleur = $value; }
		public function setPoids($value) { 
			$this->poids = $value; 
			if($value > 3.5) {
				$this->is_comercial = true;
			}
		}
		public function setImagePath($value) { $this->imagePath = $value; }

		public function rouler() {
			$this->setKilometrage($this->kilometrage + 100000);
		}

		public function print() {
			ob_start();
			?>
			<div class="thumb">
				<div class="thumb__image">
					<img src="<?= $this->imagePath; ?>">
				</div>
				<div class="thumb_features">
					<table>
						<tr>
							<th>numéro de Immatriculation</th>
							<th>date de mise en circulation</th>
							<th>kilométrage</th>
							<th>modèle</th>
							<th>marque</th>
							<th>couleur</th>
							<th>poids</th>
						</tr>
						<tr>
							<td><?= ($this->immatriculation)?$this->immatriculation:''; ?></td>
							<td><?= ($this->circulation)?$this->circulation:''; ?></td>
							<td><?= ($this->kilometrage)?$this->kilometrage:''; ?></td>
							<td><?= ($this->modele)?$this->modele:''; ?></td>
							<td><?= ($this->couleur)?$this->couleur:''; ?></td>
							<td><?= ($this->poids)?$this->poids:''; ?></td>
						</tr>
					</table>
				</div>
			</div>
			<?php
			return ob_get_clean(); 
		}
	}

	$bagnole = new Voiture([
		'modele' => 'Ford',
		'immatriculation' => 'BE2345678',
		'kilometrage' => 110000,
		'circulation' => 2012,
		'imagePath' => 'http://www.cars-data.com/pictures/abarth/abarth-124-spider_3560_14.jpg'
	]);
	$bagnole->rouler();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?= $bagnole->print(); ?>
</body>
</html>





