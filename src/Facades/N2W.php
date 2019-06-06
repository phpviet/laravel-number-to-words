<?php
/**
 * @link https://github.com/phpviet/laravel-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Laravel\NumberToWords\Facades;

use InvalidArgumentException;
use PHPViet\NumberToWords\Transformer;
use Illuminate\Support\Facades\Facade;
use PHPViet\NumberToWords\DictionaryInterface;

/**
 * @method static string toWords($number)
 * @method static string toCurrency($number, $unit = 'đồng')
 *
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class N2W extends Facade
{
    /**
     * Từ điển hiện tại.
     *
     * @var null|DictionaryInterface
     */
    public static $dictionary;

    /**
     * Cache data của các từ điển.
     *
     * @var array|DictionaryInterface[]
     */
    private static $dictionaries = [];

    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor(): Transformer
    {
        $dictionary = static::$dictionary ?? static::getDefaultDictionary();
        $dictionary = static::getDictionaryInstance($dictionary);

        return app('n2w', [$dictionary]);
    }

    /**
     * Trả về từ điển mặc định trong config.
     *
     * @return DictionaryInterface
     */
    public static function getDefaultDictionary(): DictionaryInterface
    {
        return config('n2w.defaults.dictionary');
    }

    /**
     * Tạo từ điển.
     *
     * @param string $dictionary
     * @return DictionaryInterface
     */
    protected static function getDictionaryInstance(string $dictionary): DictionaryInterface
    {
        if (!$dictionaryClass = config("n2w.dictionaries.{$dictionary}")) {
            throw new InvalidArgumentException(sprintf('Dictionary (%s) is not defined!', $dictionary));
        }

        if (!isset(static::$dictionaries[$dictionaryClass])) {
            return static::$dictionaries[$dictionaryClass] = app()->make($dictionaryClass);
        }

        return static::$dictionaries[$dictionaryClass];
    }


}
