<?php

use PHPViet\Laravel\NumberToWords\Facades\N2W;

if (!function_exists('n2w')) {

    /**
     * Hàm hổ trợ chuyển đổi số sang chữ số.
     *
     * @param $number
     * @param string|null $dictionary
     * @return string
     */
    function n2w($number, string $dictionary = null): string
    {
        $currentDictionary = N2W::$dictionary;
        N2W::$dictionary = $dictionary;
        $result = N2W::toWords($number);
        N2W::$dictionary = $currentDictionary;

        return $result;
    }

}

if (!function_exists('n2c')) {

    /**
     * Hàm hổ trợ chuyển đổi số sang tiền tệ.
     *
     * @param $number
     * @param string|null $dictionary
     * @param null|string|array $unit
     * @return string
     */
    function n2c($number, $unit = null, string $dictionary = null): string
    {
        $currentDictionary = N2W::$dictionary;
        N2W::$dictionary = $dictionary;
        $result = N2W::toCurrency($number, $unit);
        N2W::$dictionary = $currentDictionary;

        return $result;
    }

}
