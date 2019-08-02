<?php
/**
 * Author: Danny Villa Kalonji
 * Date: 02/08/2019
 * Time: 03:21
 */

namespace SimToken;

use Exception\EncodingException;

class Encoder
{
    /**
     * Characters table.
     *
     * @var Table
     */
    protected $table;

    /**
     * Value to encode
     *
     * @var string
     */
    protected $value;

    /**
     * Algorithm complexity
     *
     * @var integer
     */
    protected $complexity;

    /**
     * Encoder constructor.
     *
     * @param $table
     * @param $value
     * @param int $complexity
     */
    public function __construct($table, $value, $complexity = 1)
    {
        $this->table = $table;
        $this->value = $value;
        $this->complexity = $complexity;
    }

    /**
     * Perform the encoding.
     *
     * @param $value
     * @param $salted
     * @return string|EncodingException
     */
    protected function encode($value, $salted = true)
    {
        $characters = $this->table->stringToArray($value);
        $encoded = '';
        foreach ($characters as $character) {
            $index = $this->table->indexOf($character);
            if (isset($index))
                $encoded .= $index[0].$index[1];
            else
                throw new EncodingException('Impossible to encode "'. $character .'" character. Please check allowed characters.');
        }
        return $salted ? $this->addSalt($encoded) : $encoded;
    }

    /**
     * Add salt to the encoded value.
     *
     * @param $encodedValue
     * @return string
     */
    public function addSalt($encodedValue)
    {
        $codes = $this->table->stringToArray($encodedValue);
        $salted = '';
        foreach ($codes as $key => $code) {
            if (($key % 2) == 0) {
                if ($code != '0' && (int) $code == 0)
                    $salted .= strpos($this->table->salt,$code);
                else
                    $salted .= substr($this->table->salt, $code, 1);
            } else
                $salted .= $code;
        }

        return $salted;
    }

    /**
     * Perform the encoding according to the complexity.
     *
     * @param bool $salted
     * @return EncodingException|string
     */
    public function perform($salted = true)
    {
        $encoded = $this->value;
        for ($i = 1; $i <= $this->complexity; $i++)
            $encoded = $this->encode($encoded, $salted);

        return $encoded;
    }

}