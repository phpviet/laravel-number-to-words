<?php
/**
 * @link https://github.com/phpviet/laravel-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Laravel\NumberToWords;

use InvalidArgumentException;
use Illuminate\Support\Facades\Facade;
use PHPViet\NumberToWords\DictionaryInterface;

/**
 * @method static string toWords($number)
 * @method static string toCurrency($number, $unit = 'đồng')
 *
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class N2WFacade extends Facade
{
    /**
     * Từ điển hiện tại.
     *
     * @var null|DictionaryInterface
     */
    public static $dictionary;

    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): Transformer
    {
        $dictionary = static::$dictionary ?? static::getDefaultDictionary();
        $dictionary = static::makeDictionary($dictionary);

        return app('n2w', compact('dictionary'));
    }

    /**
     * Trả về từ điển mặc định trong config.
     *
     * @return string
     */
    protected static function getDefaultDictionary(): string
    {
        return config('n2w.defaults.dictionary');
    }

    /**
     * Tạo từ điển.
     *
     * @param string $dictionary
     * @return DictionaryInterface
     */
    protected static function makeDictionary(string $dictionary): DictionaryInterface
    {
        if (! $dictionaryClass = config("n2w.dictionaries.{$dictionary}")) {
            throw new InvalidArgumentException(sprintf('Dictionary (%s) is not defined!', $dictionary));
        }

        return app()->make($dictionaryClass);
    }
}
