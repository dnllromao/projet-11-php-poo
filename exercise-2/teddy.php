<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Car {
	private $immatriculation = "FR-344-CA";
	private $circulation_date = "31-01-1988";
	public $kilometers = 100000;
	private $brand = "BMV";
	private $model = "PM600";
	public $color = "Beige";
	public $weight = 1; // tonnes
	// 
	public $reserved = false; // Audi
	public $type = "utilitaire"; // utilitaire, commerciale  (>3,5 tonnes)
	public $country = "Belgium"; // Belgique, France, Allemagne
	public $used_state = "low"; // low < 100.000 ou middle > 100.000 ou high > 200.000
	public $age = 0;

	public function __construct($immatriculation, $circulation_date, $kilometers, $brand,  $model, $color, $weight){
		$this->immatriculation = $immatriculation;
		$this->circulation_date = $circulation_date;
		$this->kilometers = $kilometers;
		$this->brand = $brand;
		$this->model = $model;
		$this->color = $color;
		$this->weight = $weight;
		// 
		$this->reserved = $this->setStatus();
		$this->type = $this->setType();
		$this->country = $this->setCountry();
		$this->used_state = $this->setUsedState();
		$this->age = $this->setAge();
	}

	public function setStatus(){
		if($this->brand == "Audi"){
			return "reserved";
		}
		return "free";
	}
	public function setType(){
		if($this->weight > 3.5){
			return "utilitaire";
		} 
		return "commerciale";
	}
	public function setCountry(){
		if (strpos($this->immatriculation, 'FR') !== false) {
		    return "France"; 
		} else if (strpos($this->immatriculation, 'BE') !== false) {
		    return "Belgique";
		} else if (strpos($this->immatriculation, 'DE') !== false) {
		    return "Allemagne";
		}
	}
	public function setUsedState(){
		if ($this->kilometers <= 100000) {
		    return "low";
		} else if ($this->kilometers <= 200000) {
		    return "middle";
		} else if ($this->kilometers > 200000) {
		    return "high";
		}
	}
	public function setAge(){
		
		$datetime1 = new DateTime($this->circulation_date);
		$datetime2 = new DateTime();
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%Y');

	}
	public function drive(){
		$this->kilometers += 100000;
		$this->used_state = $this->setUsedState();
	}

	public function display(){
		$html = "<tr>".
					"<td>".$this->immatriculation."</td>".
					"<td>".$this->circulation_date."</td>".
					"<td>".$this->kilometers."</td>".
					"<td>".$this->brand."</td>".
					"<td>".$this->model."</td>".
					"<td style='background:".$this->color."; color:white;'>".$this->color."</td>".
					"<td>".$this->weight."</td>".
					"<td>".$this->reserved."</td>".
					"<td>".$this->type."</td>".
					"<td>".$this->country."</td>".
					"<td>".$this->used_state."</td>".
					"<td>".$this->age."</td>".
			"</tr>";
		return $html;
	}
}

$cars = [
	new Car("DE-344-CA", "31-01-1988", 300000, "Renault",  "Kangoo", "blue", 2),
	new Car("FR-411-TR", "10-12-2000", 140000, "BMW",  "Fastlove", "green", 3),
	new Car("BE-268-CX", "12-06-2010", 50000, "Audi",  "A3", "red", 4)
];

$html_cars = "";
foreach ($cars as $car) {
	$html_cars .= $car->display();
}

?>

<table>
	<caption>Parc de voitures</caption>
	<thead>
		<tr>
			<th>immatriculation</th>
			<th>circulation date</th>
			<th>kilometers</th>
			<th>brand</th>
			<th>model</th>
			<th>color</th>
			<th>weight</th>
			<th>reserved</th>
			<th>type</th>
			<th>country</th>
			<th>used state</th>
			<th>age</th>
		</tr>
	</thead>
	<tbody>

	<?= $html_cars; ?>

	</tbody>
</table>