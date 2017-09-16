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
		private $pays;
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
					$this->pays = 'Belgique';
					break;

				case 'FR':
					$this->pays = 'France';
					break;

				case 'DE':
					$this->pays = 'Allemagne';
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
			if($value == 'Audi') {
				$this->is_reserved = true;
			}
		}

		private function setMarque($value) { 
			$this->marque = $value; 
		}

		public function setCouleur($value) { 
			$this->couleur = $value; 
		}

		public function setPoids($value) { 
			$this->poids = $value; 
			if($value > 3.5) {
				$this->is_comercial = true;
			}
		}
		
		public function setImagePath($value) { 
			$this->imagePath = $value; 
		}

		public function drive() {
			$this->setKilometrage($this->kilometrage + 100000);
		}

		public function display() {
			ob_start();
			?>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<a href="#" class="thumbnail">
					      <img src="<?= $this->imagePath; ?>" alt="...">
					    </a>
					</div>
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table table-striped">
								<tr>
									<th>#</th>
									<th>valor</th>
								</tr>
								<tr>
									<td>numéro d'immatriculation</th>
									<td><?= $this->immatriculation; ?></th>
								</tr>
								<tr>
									<td>date de mise en circulation</th>
									<td><?= $this->circulation; ?></th>
								</tr>
								<tr>
									<td>kilométrage</th>
									<td><?= $this->kilometrage; ?></th>
								</tr>
								<tr>
									<td>modèle</th>
									<td><?= $this->modele; ?></th>
								</tr>
								<tr>
									<td>marque</th>
									<td><?= $this->marque; ?></th>
								</tr>
								<tr>
									<td>couleur</th>
									<td><?= $this->couleur; ?></th>
								</tr>
								<tr>
									<td>poids</th>
									<td><?= $this->poids; ?></th>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php
			return ob_get_clean(); 
		}
	}

	$bagnole = new Voiture([
		'immatriculation' => 'BE2345678',
		'circulation' => 2012,
		'kilometrage' => 110000,
		'modele' => '4C',
		'marque' => 'Audi',
		'couleur' => 'black',
		'poids' => '3.1',
		'imagePath' => 'http://www.cars-data.com/pictures/audi/audi-r8_3403_1.jpg'
	]);
	$bagnole->drive();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Parc de voitures</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<?= $bagnole->display(); ?>
	
</body>
</html>





