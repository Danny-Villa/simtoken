<?php
/**
 * Author: Danny Villa Kalonji
 * Date: 02/08/2019
 * Time: 12:43
 */

namespace SimToken;


class Table
{
    /**
     * All available value according to their indexation.
     *
     * @var array
     */
    private $values = [
        1 => ['a','b','c','A','B','C','â','à','5'],
        2 => ['d','e','f','D','E','F','é','è','4'],
        3 => ['g','h','i','G','H','I','î','ï','3'],
        4 => ['j','k','l','J','K','L','ë','^','2'],
        5 => ['m','n','o','M','N','O','ç','ô','1'],
        6 => ['p','q','r','s','P','Q','R','S','0'],
        7 => ['t','u','v','T','U','V','û','ü','9'],
        8 => ['w','x','y','z','W','X','Y','Z','8'],
        9 => [':','+','"','/','\\','|','&','=','7'],
        0 => ['-','_','*',"'",'`','?','!',' ','6'],
        'a' => ['.',',',';','<','>','(',')','#','@'],
        'b' => ['%','$','£','ù','µ','']
    ];

    /**
     * Salts characters.
     *
     * @var array
     */
    public $salt = '0abcdefghijklmnopqrstuvwxyz';

    /**
     * Get index of a given character.
     *
     * @param $character
     * @return array|null
     */
    public function indexOf($character)
    {
        $row = 0;
        $index = -1;
        foreach ($this->values as $key => $value) {
            foreach ($value as $i => $item ) {
                if ($item == $character) {
                    $row = $key;
                    $index = $i;
                }
            }
        }
        if ($row == 0 && $index == -1)
            return null;
        return [$row,$index];
    }

    /**
     * Get character for given index.
     *
     * @param $row
     * @param $index
     * @return bool|string
     */
    public function valueOf($row, $index)
    {
        return $this->values[$row][$index] ?? false;
    }

    /**
     * Transform a simple string to array.
     *
     * @param $value
     * @return array
     */
    public function stringToArray($value)
    {
        $value = (string) $value;
        $splited = [];
        for ($i = 0; $i < strlen($value); $i++)
            $splited[] = $value[$i];
        return $splited;
    }
}