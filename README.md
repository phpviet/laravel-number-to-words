<p align="center">
    <a href="https://github.com/laravel" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/958072" height="100px">
    </a>
    <h1 align="center">Laravel Number To Words</h1>
    <br>
    <p align="center">
    <a href="https://packagist.org/packages/phpviet/laravel-number-to-words"><img src="https://img.shields.io/packagist/v/phpviet/laravel-number-to-words.svg?style=flat-square" alt="Latest version"></a>
    <a href="https://travis-ci.org/phpviet/laravel-number-to-words"><img src="https://img.shields.io/travis/phpviet/laravel-number-to-words/master.svg?style=flat-square" alt="Build status"></a>
    <a href="https://scrutinizer-ci.com/g/phpviet/laravel-number-to-words"><img src="https://img.shields.io/scrutinizer/g/phpviet/laravel-number-to-words.svg?style=flat-square" alt="Quantity score"></a>
    <a href="https://styleci.io/repos/190297766"><img src="https://styleci.io/repos/190297766/shield?branch=master" alt="StyleCI"></a>
    <a href="https://packagist.org/packages/phpviet/laravel-number-to-words"><img src="https://img.shields.io/packagist/dt/phpviet/laravel-number-to-words.svg?style=flat-square" alt="Total download"></a>
    <a href="https://packagist.org/packages/phpviet/laravel-number-to-words"><img src="https://img.shields.io/packagist/l/phpviet/laravel-number-to-words.svg?style=flat-square" alt="License"></a>
    </p>
</p>

## Thông tin

Laravel number to words hổ trợ chuyển đổi số sang chữ số Tiếng Việt.

## Cài đặt

Cài đặt Laravel Number To Words thông qua [Composer](https://getcomposer.org):

```bash
composer require phpviet/laravel-number-to-words
```

## Cách sử dụng

### Các tính năng của extension:

- [`Chuyển đổi số sang chữ số`](#Chuyển-đổi-số-sang-chữ-số)
- [`Chuyển đổi số sang tiền tệ`](#Chuyển-đổi-số-sang-tiền-tệ)
- [`Thay cách đọc số`](#Thay-cách-đọc-số)

### Chuyển đổi số sang chữ số

+ Sử dụng thông qua facade `N2W`:

```php
use N2W;

// âm năm
N2W::toWords(-5); 

// năm
N2W::toWords(5); 

// năm phẩy năm
N2W::toWords(5.5); 
```

+ Sử dụng thông qua hàm hổ trợ `n2w`:

```php
// mười lăm
n2w(15); 

// một trăm linh năm
n2w(105); 

// hai mươi tư
n2w(24); 
```

### Chuyển đổi số sang tiền tệ

+ Sử dụng thông qua facade `N2W`:

```php
use N2W;

// năm triệu sáu trăm chín mươi nghìn bảy trăm đồng
N2W::toCurrency(5690700);
```

+ Sử dụng thông qua hàm hổ trợ `n2c`:

```php
// chín mươi lăm triệu năm trăm nghìn hai trăm đồng
n2c(95500200);
```

Ngoài ra ta còn có thể sử dụng đơn vị tiền tệ khác thông qua tham trị thứ 2 của phương thức
`toCurrency` và hàm `n2c` với mảng phần từ đầu tiên là đơn vị cho số nguyên và kế tiếp là đơn vị của phân số:

```php
use N2W;

// sáu nghìn bảy trăm bốn mươi hai đô bảy xen
N2W::toCurrency(6742.7, ['đô', 'xen']);

// chín nghìn bốn trăm chín mươi hai đô mười lăm xen
n2c(9492.15, ['đô', 'xen']);
```

### Thay cách đọc số

> Nếu như bạn cảm thấy cách đọc ở trên ổn rồi thì hãy bỏ qua bước này.

Đầu tiên để thay đổi cách đọc số bạn cần phải publish file cấu hình thông qua câu lệnh:

```php
php artisan vendor:publish --provider="PHPViet\Laravel\NumberToWords\ServiceProvider" --tag="config"
```

Sau khi publish xong ta sẽ có được file config `config/n2w.php` như sau:

```php
return [
    /**
     * Cấu hình từ điển mặc định theo chuẩn chung của cả nước
     */
    'defaults' => [
        'dictionary' => 'standard',
    ],
    'dictionaries' => [
        /**
         * Cấu hình các từ điển custom theo ý bạn.
         */
        'standard' => PHPViet\NumberToWords\Dictionary::class,
        'south' => PHPViet\NumberToWords\SouthDictionary::class
    ]
];
```

Ngay bây giờ bạn hãy thử đổi default `standard` sang `south`, toàn bộ phương thức chuyển
đổi số sang chữ số và tiền tệ sẽ đọc theo phong cách trong Nam:

```php
use N2W;

// một trăm linh một => một trăm lẻ một
N2W::toWords(101);

// một nghìn => một ngàn
N2W::toWords(1000);

 // hai mươi tư => hai mươi bốn
N2W::toWords(24);

// một trăm hai mươi tư nghìn không trăm linh một đồng => một trăm hai mươi bốn ngàn không trăm lẻ một đồng
N2W::toCurrency(124001);
```

hoặc bạn muốn sử dụng linh động hơn thì hãy chỉ định từ điển:

```php
// một trăm hai mươi tư nghìn không trăm linh một
n2w(124001);

// một trăm hai mươi bốn ngàn không trăm lẻ một
n2w(124001, 'south');
```

Nếu như bạn muốn thay đổi cách đọc theo ý bạn thì hãy tạo một lớp `Dictionary` kế thừa
`PHPViet\NumberToWords\Dictionary` hoặc thực thi mẫu trừu tượng `PHPViet\NumberToWords\DictionaryInterface`:

```php

use PHPViet\NumberToWords\Dictionary;
use PHPViet\NumberToWords\Transformer;

class MyDictionary extends Dictionary {

    /**
     * @inheritDoc
     */
    public function specialTripletUnitFive(): string
    {
        return 'nhăm';
    }

}
```

Sau đó khai báo vào config:

```php
return [
    /**
     * Cấu hình từ điển mặc định theo chuẩn chung của cả nước
     */
    'defaults' => [
        'dictionary' => 'my',
    ],
    'dictionaries' => [
        /**
         * Cấu hình các từ điển custom theo ý bạn.
         */
        'standard' => PHPViet\NumberToWords\Dictionary::class,
        'south' => PHPViet\NumberToWords\SouthDictionary::class,
        'my' => MyDictionary::class
    ]
];
```

Và hãy thử ngay:

```php
use N2W;

// mười nhăm
N2W::toWords(15);
```

## Dành cho nhà phát triển

Nếu như bạn cảm thấy extension còn thiếu sót hoặc sai sót và bạn muốn đóng góp để phát triển chung,
chúng tôi rất hoan nghênh! Hãy tạo các `issue` để đóng góp ý tưởng cho phiên bản kế tiếp
hoặc tạo `PR` để đóng góp. Cảm ơn!
