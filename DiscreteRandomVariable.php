<?php
/**
 * Discrete random variable for calculations, uses a uniform distribution based on occurences to calculate
 * @package R
 */
class DiscreteRandomVariable extends RandomVariable implements JsonSerializable {
	private $distribution; //The distribution dataset which stores the number of occurences and probabilitiy for each outcome
	private $total_occurences; //The number of total occurences stored in the distribution

	public function __construct() {
		$this->total_occurences = 0;
		$this->distribution = array();
	}

	/**
	 * Adds an occurence to the random variable
	 * @param String $key The key to be added
	 * @param Int the value to be added, default is 1
	 * @return null
	 */
	public function add($key, $val) {
		$this->total_occurences += 1;
		if (isset($this->distribution[$key])) {
			$this->distribution[$key]['occurences'] += $val;
		}
		else {
			$this->distribution[$key] = array(
				'occurences' => 1,
			);
		}
	}

	/**
	 * Returns an array of all the keys of the Random Variable to iterate upon
	 * @return array
	 */
	public function key_iterator() {
		return array_keys($this->distribution);
	}

	/**
	 * Gets the probability of a certain key
	 * @param String A valid value the random variable can take on (key) 
	 * @return float
	 */
	public function get_probability($key) {
		return $this->distribution[$key]['occurences'] / $this->total_occurences;
	}

	/**
	 * Gets the occurences of a key that was used to calculate its probabilitys
	 * If null, then returns all occurences
	 * @param String $key A valid value the random variable can take on
	 * @return int
	 */
	public function get_occurences($key=null) {
		if (is_null($key)) {
			return $this->total_occurences;
		}
		return $this->distribution[$key]['occurences'];
	}

	/**
	 * Gets the distribution of the random variable
	 * @return array
	 */
	public function get_distribution() {
		return $this->distribution;
	}

	/**
	 * Implementation of JsonSerializable for a representation of the Random Variable
	 * @return array
	 */
	public function jsonSerialize() {
		$returnArray = array();

		$returnArray['distribution'] = $this->get_distribution();
		$returnArray['total_occurences'] = $this->get_occurences();

		//Get expected value
		$returnArray['expected_value'] = DiscreteRandomVariableService::expected_value($this);

		//Get the variance
		$returnArray['variance'] = DiscreteRandomVariableService::variance($this);

		//Get the standard deviation
		$returnArray['standard_deviation'] = DiscreteRandomVariableService::standard_deviation($this);

		return $returnArray;
	}

}