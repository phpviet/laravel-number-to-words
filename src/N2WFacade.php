<?php
/**
 * @link https://github.com/phpviet/laravel-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Laravel\NumberToWords;

use Illuminate\Support\Facades\Facade;
use InvalidArgumentException;
use PHPViet\NumberToWords\DictionaryInterface;
use LogicException;

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
        static::checkConfigIsPublished();

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

    /**
     * Throw an Exception when the config is not exist
     * Please run: php artisan vendor:publish --provider="PHPViet\Laravel\NumberToWords\ServiceProvider" --tag="config"
     *
     * @throws LogicException
     */
    protected static function checkConfigIsPublished()
    {
        if (!config()->has('n2w')) {
            throw new LogicException("The config file is not found. You must publish the config before using it!");
        }
    }
}
