<?php 
/**
 * Class for some Bionomial Distribution
 * @package default
 */
class Binomial extends RandomVariable {
	private $n, $p;

	/**
	 * Constructs some Bionomail Distribution instance
	 * @param float $n 
	 * @param float $p 
	 * @throws UnexpectedValueException if n or p is not numeric
	 * @return null
	 */
	public function __construct($n, $p) {
		$this->set_p($p);
		$this->set_n($n);
	}

	/**
	 * Sets the p of the Bionomial Distribution
	 * @param float $p 
	 * @return null
	 * @throws UnexpectedValueException if p is not numeric
	 */
	public function set_p($p) {
		if (is_numeric($p)) {
			$this->p = $p;
		}
		else {
			throw new UnexpectedValueException;
		}
	}

	/**
	 * Sets the n (number of trials) of the Bionomial Distribution
	 * @param float $n 
	 * @return null
	 * @throws UnexpectedValueException if the n is not numeric
	 */
	public function set_n($n) {
		if (is_numeric($n)) {
			$this->n = $n;
		}
		else {
			throw new UnexpectedValueException;
		}
	}

	/**
	 * Gets the n of this Bionomial Distribution instance
	 * @return float
	 */
	public function get_n() {
		return $this->n;
	}

	/**
	 * Gets the p (probaibliy) of the Bionomial Distribution instance
	 * @return float
	 */
	public function get_p() {
		return $this->p;
	}

	/**
	 * Gets the probaibiliy using the pmf function of a certain outcome
	 * @param float $x Outcome
	 * @return float
	 * @throws UnexpectedValueException if x is not an int
	 */
	public function get_probability($x) {
		if (is_int($x)) {
			return (gmp_fact($this->n)/(gmp_fact($x)*gmp_fact(($this->n - $x))))*exp($this->p, $x)*exp((1-$this->p), ($this->n - $x));
		}
		else {
			throw new UnexpectedValueException('UnexpectedValueException occured because BionomailDistribution is not continous so x cannot be a non-integer');
		}
	}

	/**
	 * Gets the P(X < x) of the function 
	 * @param int $x
	 * @return float
	 * @throws UnexpectedValueException if x is not valid for the cdf
	 */
	public function get_less_than_or_equal($x) {
		if (is_int($x)) {
			$probability = 0;
			for ($i = 0; $i <= $x; $i++) {
				$probability += $this->get_probability($i);
			}
			return $probability;
		}
		else {
			throw new UnexpectedValueException('UnexpectedValueException occured because BionomailDistribution is not continous and x cannot be non-integer');
		}
	}
}