<?php
/**
  * Class for some ExponentialDistribution Random Variable
  * @package R
  */ 
class ExponentialDistribution extends RandomVariable {
	private $lambda;

	public function __construct($lambda) {
		$this->set_lambda($lamdba);
	}

	public function set_lambda($lambda) {
		if (is_numeric($lamdba)) {
			$this->lambda = $lambda;
		}
		else {
			throw new UnexpectedValueException;
		}
		
	}

	public function get_lambda() {
		return $this->lambda;
	}

	public function get_probability($x) {
		return $this->lambda*exp(M_E, ($this->lambda*$x*-1));
	}

	public function get_less_than_equal($x) {
		return 1 - exp(M_E, ($lambda*$x*-1));
	}
}
