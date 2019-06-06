<?php

use PHPViet\Laravel\NumberToWords\N2WFacade;

if (! function_exists('n2w')) {

    /**
     * Hàm hổ trợ chuyển đổi số sang chữ số.
     *
     * @param int|float $number
     * @param string|null $dictionary
     * @return string
     */
    function n2w($number, string $dictionary = null): string
    {
        $currentDictionary = N2WFacade::$dictionary;
        N2WFacade::$dictionary = $dictionary;
        $result = N2WFacade::toWords($number);
        N2WFacade::$dictionary = $currentDictionary;

        return $result;
    }
}

if (! function_exists('n2c')) {

    /**
     * Hàm hổ trợ chuyển đổi số sang tiền tệ.
     *
     * @param $number
     * @param string|null $dictionary
     * @param null|string|array $unit
     * @return string
     */
    function n2c($number, $unit = 'đồng', string $dictionary = null): string
    {
        $currentDictionary = N2WFacade::$dictionary;
        N2WFacade::$dictionary = $dictionary;
        $result = N2WFacade::toCurrency($number, $unit);
        N2WFacade::$dictionary = $currentDictionary;

        return $result;
    }
}
