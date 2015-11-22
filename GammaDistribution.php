<?php
/**
  * Class for some GammaDistribution RandomVariable
  * @package R
  */ 
class GammaDistribution extends RandomVariable {
	private $lambda;
	private $gamma;

	public function __construct($gamma, $lambda) {
		$this->set_lambda($lambda);
		$this->set_gamma($gamma);
	}

	public function set_gamma($gamma) {
		if (is_numeric($gamma)) {
			$this->gamma = $gamma;
		}
		else {
			throw new UnexpectedValueException;
		}
	}

	public function set_lambda($lambda) {
		if (is_numeric($lambda)) {
			$this->lambda = $lambda;
		}
		else {
			throw new UnexpectedValueException;
		}
	}

	public function get_probability($x) {
		return null;
	}
}
?>