<?php

namespace App\Helpers;

use Carbon\Carbon;
use NumberFormatter;

class Formatter
{

    /**
     * Format number to money (Rp.)
     *
     * @param int $value
     * @return string
     */
    public static function moneyFormat($value)
    {
        return "Rp " . number_format($value, 0, '.', ',');
    }

    /**
     * @param int $value
     * @return string
     */
    public static function moneySpellout($value)
    {
        $f = new NumberFormatter("id", NumberFormatter::SPELLOUT);
        return ucwords($f->format($value));
    }

    /**
     * Format date/datetime to local date
     *
     * @param string $datetime
     * @return string
     */

    public static function dateFormat($dt, $format = 'd F Y')
    {
        if ($dt instanceof \Carbon\Carbon) {
            return $dt->translatedFormat($format);
        }

        return \Carbon\Carbon::parse($dt)->translatedFormat($format);
    }


    /**
     * Format datetime to local datetime
     *
     * @param string $datetime
     * @return string
     */
    public static function datetimeFormat($dt, $format = 'd F Y H:i:s')
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $dt);
        return $date->translatedFormat($format);
    }

    /**
     * Format number to Roman numeral
     *
     * @param int $number
     * @return string
     */
    public static function numberToRomanRepresentation($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}
