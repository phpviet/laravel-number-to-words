<?php
/**
 * @link https://github.com/phpviet/laravel-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Laravel\NumberToWords\Tests;

use N2W;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class FacadeTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testTransform($expect, $number)
    {
        $this->assertEquals($expect, N2W::toWords($number));
    }

    /**
     * @dataProvider currencyDataProvider
     */
    public function testCurrencyTransform($expect, $number)
    {
        $this->assertEquals($expect, N2W::toCurrency($number));
    }
}
