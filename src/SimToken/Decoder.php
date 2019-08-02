<?php
/**
 * Author: Danny Villa Kalonji
 * Date: 02/08/2019
 * Time: 15:38
 */

namespace SimToken;

use Exception\DecodingException;

class Decoder
{
    /**
     * Characters table.
     *
     * @var Table
     */
    protected $table;

    /**
     * Value to decode
     *
     * @var string
     */
    protected $encoded_value;

    /**
     * Algorithm complexity
     *
     * @var integer
     */
    protected $complexity;

    /**
     * Decoder constructor.
     *
     * @param $table
     * @param $encodedValue
     * @param int $complexity
     */
    public function __construct($table, $encodedValue, $complexity = 1)
    {
        $this->complexity = $complexity;
        $this->table = $table;
        $this->encoded_value = $encodedValue;
    }

    /**
     * Perform the decoding.
     *
     * @param $encodedValue
     * @param bool $salted
     * @return string
     */
    public function decode($encodedValue, $salted = true)
    {
        $encodedValue = $salted ? $this->removeSalt($encodedValue) : $encodedValue;
        $characters = $this->table->stringToArray($encodedValue);
        $value = '';
        foreach ($characters as $key => $character) {
            // Assume that only lines had to be read.
            if (($key) % 2 == 0) {
                if (!$this->table->valueOf($character, $characters[$key + 1]))
                    throw new DecodingException('Impossible to decode this encoded value');
                $value .= $this->table->valueOf($character, $characters[$key + 1]);
            }
        }
        return $value;
    }

    /**
     * Remove salt from a given encoded value.
     *
     * @param $encodedValue
     * @return string
     */
    public function removeSalt($encodedValue)
    {
        $codes = $this->table->stringToArray($encodedValue);
        $unsalted = '';

        foreach ($codes as $key => $code) {
            if (($key % 2) == 0) {
                if ($code != '0' && (int) $code == 0)
                    $unsalted .= strpos($this->table->salt,$code);
                else
                    $unsalted .= substr($this->table->salt, $code, 1);
            } else
                $unsalted .= $code;
        }
        return $unsalted;
    }

    /**
     * Perform the decoding according to the complexity.
     *
     * @param bool $salted
     * @return string
     */
    public function perform($salted = true)
    {
        $value = $this->encoded_value;
        for ($i = 1; $i <= $this->complexity; $i++)
            $value = $this->decode($value, $salted);
        return $value;
    }
}