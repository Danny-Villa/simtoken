<?php
/**
 * Author: Danny Villa Kalonji
 * Date: 02/08/2019
 * Time: 03:17
 */

namespace SimToken;

use function Sodium\randombytes_uniform;

require ('Encoder.php');
require ('Decoder.php');
require ('Table.php');


class SimToken
{
    /**
     * Encode a plain text to simtoken (simple token).
     *
     * @param $value
     * @param bool $salted
     * @param int $complexity
     * @return \Exception\EncodingException|string
     */
    public static function encode($value, $salted = true, $complexity = 1)
    {
        $encoder = new Encoder(new Table(), $value, $complexity);
        return $encoder->perform($salted);
    }

    /**
     * Decode a simtoken (simple token) to plain text.
     *
     * @param $encodedValue
     * @param bool $salted
     * @param int $complexity
     * @return string
     */
    public static function decode($encodedValue, $salted = true, $complexity = 1)
    {
        $decoder = new Decoder(new Table(), $encodedValue, $complexity);
        return $decoder->perform($salted);
    }
}