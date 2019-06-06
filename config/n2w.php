<?php
/**
 * @link https://github.com/phpviet/laravel-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

return [
    /*
     * Cấu hình từ điển mặc định theo chuẩn chung của cả nước
     */
    'defaults' => [
        'dictionary' => 'standard',
    ],
    'dictionaries' => [
        /*
         * Cấu hình các từ điển custom theo ý bạn.
         */
        'standard' => PHPViet\NumberToWords\Dictionary::class,
        'south' => PHPViet\NumberToWords\SouthDictionary::class,
    ],
];
