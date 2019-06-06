<?php
/**
 * @link https://github.com/phpviet/laravel-number-to-words
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace PHPViet\Laravel\NumberToWords;

use PHPViet\NumberToWords\Transformer;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class ServiceProvider extends BaseServiceProvider implements DeferrableProvider
{

    public $bindings = [
        'n2w' => Transformer::class
    ];

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/n2w.php' => config_path('n2w.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/n2w.php', 'n2w');
    }

    public function provides(): array
    {
        return ['n2w'];
    }

}
