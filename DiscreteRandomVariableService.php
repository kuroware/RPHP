<?php 
/**
 * Provides services for a Discrete Random Variable 
 * @package R
 */
class DiscreteRandomVariableService {

	/**
	 * Sums up the probability distribution
	 * @param DiscreteRandomVariable $randomVariable 
	 * @param function CallbkacFunction, a function to be applied on every key
	 * @return float
	 */
	public static function sum(DiscreteRandomVariable $randomVariable, $callbackFunction) {
		$keys = $randomVariable->key_iterator();
		$sum = 0;
		foreach ($keys as $key) {
			$sum += (float) $callbackFunction($key) * $randomVariable->get_probability($key);
		}
		return $sum;
	}

	/**
	 * Gets the expected value (the mean) of a random variable
	 * @param DiscreteRandomVariable $randomVariable 
	 * @return float
	 */
	public static function expected_value(DiscreteRandomVariable $randomVariable) {
		return self::sum($randomVariable, function($key) {
			return $key;
		});
	}

	/**
	 * Gets the variance of a random variable
	 * @param DiscreteRandomVariable $randomVariable 
	 * @return float
	 */
	public static function variance(DiscreteRandomVariable $randomVariable) {
		$expected_value = self::expected_value($randomVariable);
		return (self::sum($randomVariable, function($key) use ($expected_value) {
			return pow(($key - $expected_value), 2);
		}));
	}

	/**
	 * Gets the standard deviation of a random variable
	 * @param type DiscreteRandomVariable $randomVariable 
	 * @return float
	 */
	public static function standard_deviation(DiscreteRandomVariable $randomVariable) {
		return sqrt(self::variance($randomVariable));
	}
}