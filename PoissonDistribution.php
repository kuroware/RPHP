<?php 
/**
 * Class for some Poisson Distribution
 * @package default
 */
class Poisson extends RandomVariable {
	private $lambda;

	public function __construct($lambda) {
		$this->lambda = $lambda;
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
		if (is_numeric($x)) {
			return (exp($this->lambda, $x)*exp(M_E, ($this->lambda*-1)))/(gmp_fact($x));
		}
		else {
			throw new UnexpectedValueException;
		}
	}

	/**
	 * Gets such that P(X < x)
	 * @param int $x
	 * @return float
	 * @throws UnexpectedValueException if x does not fit the constraints
	 */
	public function get_less_than_equal($x) {
		if (is_int($x)) {
			$probability = 0;
			for ($i=0;$i<=$x;$i++) {
				$probability += $this->get_probability($i);
			}
			return $probability;
		}
		else {
			throw new UnexpectedValueException('UnexpectedValueException occured because PoissonDistribution is not continous so x cannot be a non-integer');
		}
	}
}