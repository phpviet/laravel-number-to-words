<?php
/**
 * @link https://github.com/phpviet/laravel-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Laravel\NumberToWords;

use Illuminate\Support\Traits\Macroable;
use PHPViet\NumberToWords\Transformer as BaseTransformer;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Transformer extends BaseTransformer
{
    use Macroable;
}
