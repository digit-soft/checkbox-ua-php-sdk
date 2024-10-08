[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![PHP >=8.3](https://img.shields.io/badge/php-%3E=_8.3-orange.svg?style=flat-square)](https://github.com/digit-soft/checkbox-ua-php-sdk)

# checkbox-ua-php-sdk
### PHP SDK для работи з Checkbox (Україна)

##### Примітка:

> __За основу взято SDK з <https://github.com/igorbunov/checkbox-in-ua-php-sdk>__, внесено деякі зміни для зручності роботи з API та перекладено на українську мову.
> Вдячний пану [igorbunov](https://github.com/igorbunov) за його роботу над цим репо.

> В даному SDK реалізовані тільки функції онлайн режиму (офлайн ніт)

#### Офіційна документація:

<https://api.checkbox.ua/api/redoc>

<https://api.checkbox.ua/api/docs>

<https://wiki.checkbox.ua/uk/api>

#### Встановлення:
```bash
composer require digit-soft/checkbox-ua-php-sdk
```

#### Налаштування

```php
require_once 'vendor/autoload.php';
```

##### Налаштування конфігу:

> адреса серверу http://api.checkbox.ua (тепер тільки одна адреса для продакш та тестування)<br>
> версія API - v1

```php
$config = \DigitSoft\Checkbox\Config::makeWithPin(
    'ключ лицензії каси',
    'PIN-код'
)
```
або

```php
$config = \DigitSoft\Checkbox\Config::makeWithLoginPass(
    'ключ лицензії каси',
    'логін касира',
    'пароль касира'
)
```

##### Логін кассира:

```php
$api = new \DigitSoft\Checkbox\CheckboxJsonApi($config);
$api->cashier()->signIn();
```
##### Логаут кассира:
```php
$api->cashier()->signOut();
```
##### Помилки (Exceptions):

```php
\DigitSoft\Checkbox\Exceptions\InvalidCredentials - невірні дані логіну чи паролю
```

```php
\DigitSoft\Checkbox\Exceptions\EmptyResponse - порожня відповідь
```

```php
\DigitSoft\Checkbox\Exceptions\Validation - помилка валидації (є детальні дані $err->getDetail())
```

```php
\DigitSoft\Checkbox\Exceptions\NoActiveShift - Немає активної зміни
```

```php
\DigitSoft\Checkbox\Exceptions\AlreadyOpenedShift - Зміна вже відкрита
```
```php
\Exception  - стандартна помилка
```

#### Основні методи:

##### profile (касир):
```php
$api->cashier()->getProfile() : \DigitSoft\Checkbox\Models\Cashier\Cashier // повертає профіль касира
```
##### shifts (зміни):
```php
$api->cashier()->getShift() : \DigitSoft\Checkbox\Models\Shifts\Shift // повертає поточну зміну касира
```
```php
$api->shifts()->one('ID зміни') : \DigitSoft\Checkbox\Models\Shifts\Shift // повертає зміну по ID
```
```php
$api->shifts()->all() : \DigitSoft\Checkbox\Models\Shifts\Shifts // повертає зміни
```
або
```php
$api->shifts()->all(
    new \DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams(
        [
            \DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams::STATUS_CLOSED,
            \DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams::STATUS_OPENED
        ], // статуси змін
        false, // desc - сортування (false || true)
        2, // limit
        0  // offset
    )
): \DigitSoft\Checkbox\Models\Shifts\Shifts // повертає зміни з урахуванням фільтру
```
```php
$api->shifts()->create() : \DigitSoft\Checkbox\Models\Shifts\CreateShift // створює/відкриває зміну
```
```php
$api->shifts()->close() : \DigitSoft\Checkbox\Models\Shifts\CloseShift // закриває зміну
```
##### cash registers (пРРО):
```php
$api->cashRegisters()->all() : \DigitSoft\Checkbox\Models\CashRegisters\CashRegisters // повертає касові реєстратори (пРРО)
```
або
```php
$api->cashRegisters()->all(
    new \DigitSoft\Checkbox\Models\CashRegisters\CashRegistersQueryParams(
        true, // inUse - використовується чи ні (true or false)
        3, // limit
        0  // offset
    )
) : \DigitSoft\Checkbox\Models\CashRegisters\CashRegisters // повертає касові реєстратори по фільтру
```
```php
$api->cashRegisters()->one('ID каси') : \DigitSoft\Checkbox\Models\CashRegisters\CashRegister // повертає касу по ID
```
```php
$api->cashRegisters()->info() : \DigitSoft\Checkbox\Models\CashRegisters\CashRegisterInfo // повертає інформацію по поточній касі
```
##### taxes (податки):
```php
$api->taxes()->all() : \DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes // повертає всі податки
```
```php
$api->taxes()->allByCashier() : \DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes // повертає всі податки по поточному касиру
```
##### transactions (транзакції):
```php
$api->transactions()->all(
    new \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams(
        [
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::STATUS_CREATED,
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::STATUS_DONE,
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::STATUS_SIGNED
        ], // статуси транзакцій
        [
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::TYPE_RECEIPT,
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::TYPE_SHIFT_OPEN,
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::TYPE_Z_REPORT
        ], // типи транзакцій
        2, // limit
        0  // offset
    )
) : \DigitSoft\Checkbox\Models\Transactions\Transactions // повертає транзакції по фільтру
```
```php
$api->transactions()->one('ID транзакції') : \DigitSoft\Checkbox\Models\Transactions\Transaction // повертає транзакцію по ID
```
```php
// Увага! Даний ендпоінт API на даний момент вже прибраний з документації
$api->transactions()->update(
    'ID транзакції',
    base64_encode('request_signature')
) : \DigitSoft\Checkbox\Models\Transactions\Transaction // змінює request_signature в транзакції, працює тільки якщо у неї статус PENDING
```
##### reports (звіти):
```php
$api->reports()->createX() : \DigitSoft\Checkbox\Models\Shifts\ZReport // створює X звіт
```
```php
$api->reports()->one('ID звіту') : \DigitSoft\Checkbox\Models\Shifts\ZReport // повертає дані звіту по ID
```
```php
$api->reports()->oneAsText('ID звіту') : string // повертає дані звіту по ID у вигляді тексту
```
або
```php
$api->reports()->oneAsText('ID звіту', 60) : string // повертає дані звіту по ID у вигляді тексту, із вказанням ширини тексту
```
```php
$api->reports()->onePeriodical(
    new \DigitSoft\Checkbox\Models\Reports\PeriodicalReportQueryParams(
        '2020-10-27T00:00:00+03:00', // дата з
        '2020-11-04T13:15:00+03:00', // дата по
        60 // ширина тексту
    )
) : string // повертає дані звіту за період по фільтру
```
```php
$api->reports()->all(
    new \DigitSoft\Checkbox\Models\Reports\ReportsQueryParams(
        '2020-10-27T00:00:00+03:00', // дата з
        '2020-11-04T13:15:00+03:00', // дата по
        [], // масив ID змін
        false, // is_z_report (true or false)
        true, // desc - сортування (false or true)
        3, // limit
        0 // offset
    )
) : \DigitSoft\Checkbox\Models\Reports\Reports // повертає звіт по фільтру
```
##### receipts (чеки):
```php
$api->receipts()->all() : \DigitSoft\Checkbox\Models\Receipts\Receipts // повертає чеки
```
```php
$api->receipts()->all(
    new \DigitSoft\Checkbox\Models\Receipts\ReceiptsQueryParams(
        '', // fiscal code
        '', // serial
        false, // desc - сортування (false or true)
        2, // limit
        0 // offset
    )
) : \DigitSoft\Checkbox\Models\Receipts\Receipts // повертає чеки по фільтру
```
```php
$api->receipts()->one('ID чеку') : \DigitSoft\Checkbox\Models\Receipts\Receipt // повертає чек по ID
```
```php
$api->receipts()->oneAsPdf('ID чеку') : string // повертає чек по ID у вигляді PDF
```
```php
$api->receipts()->oneAsHtml('ID чеку') : string // повертає чек по ID у вигляді HTML
```
```php
$api->receipts()->oneAsText('ID чеку') : string // повертає чек по ID у вигляді тексту
```
```php
$api->receipts()->oneAsImageQrCode('ID чеку') : string // повертає чек по ID у вигляді QR коду
```
або
```php
// Приклад з відображенням QR-коду
$rawImageContent = $api->receipts()->oneAsImageQrCode('ID чеку');
echo '<img src="data:image/png;base64,' . base64_encode($rawImageContent) . '"/>';
```
###### чек продажи:
```php
$receipt = new \DigitSoft\Checkbox\Models\Receipts\SellReceipt(
    'Вася Пупкін', // касир
    'Відділ продаж', // відділ
    new \DigitSoft\Checkbox\Models\Receipts\Goods\Goods(
        [
            new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel( // товар 1
                new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel(
                    'vm-123', // good_id
                    50 * 100, // 50 грн
                    'Биовак' // назва товару
                ),
                1 * 1000 // к-сть товару  1 шт
            ),
            new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel( // товар 2
                new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel(
                    'vm-124', // good_id
                    20 * 100, // 20 грн
                    'Биовак 2' // назва товару
                ),
                2 * 1000 // к-сть товару 2 шт
            )
        ]
    ),
    'admin@gmail.com', // кому надсилати чек на пошту
    new \DigitSoft\Checkbox\Models\Receipts\Payments\Payments([
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload( // безготівкова оплата
            40 * 100 // 40 грн
        ),
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload( // готівкова оплата
            50 * 100 // 50 грн
        )
    ])
);

$api->receipts()->createSell($receipt): \DigitSoft\Checkbox\Models\Receipts\Receipt; // виконуємо оплату
```
більш складна оплата
```php
$allTaxes = $api->taxes()->all(); // отримали всі податки
$tax = $allTaxes->getTaxByLabel('Акцизний збір'); // отримали один податок за назвою (поле label)
$goodTaxes = $allTaxes->getTaxesByLabel('ПДВ'); // отримали масив податків по label
$taxCodes = [];

// Підготуємо масив кодів податків
foreach ($goodTaxes->results as $goodTax) {
    $taxCodes[] = $goodTax->code;
}

$receipt = new \DigitSoft\Checkbox\Models\Receipts\SellReceipt(
    'Вася Пупкін', // Ім'я касира
    'Відділ продажу', // Відділ
    new \DigitSoft\Checkbox\Models\Receipts\Goods\Goods( // товари
        [
            new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel(
                new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel(
                    'vm-123', // good_id ID товару
                    5000, // 50 грн  ціна 100 = 1 грн
                    'Біовак', // назва
                    '5р47ле78675е3', // баркод
                    'шапка', // header
                    'футер', // footer
                    '', // ktzed
                    $goodTaxes // податки товару
                ),
                1000, // к-сть 1000 = 1 шт
                new \DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts( // знижки чи надбавки
                    [
                        new \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel(
                            \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::TYPE_DISCOUNT, // знижка або надбавка
                            \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::MODE_VALUE, // по значенню чи по відсотку
                            100, // 1 грн  сума знижки/надбавки  100 = 1 грн
                            $tax->code, // код податку (підготували вище)
                            $taxCodes, // масив кодів податку (підготували вище)
                            'one good discount' // назва
                        )
                    ]
                ),
                $allTaxes->getTaxesByLabel('Акцизний збір'), // податки товару
                false, // повернення товару (false or true)
                0, // сума (не використовується в данном SDK)
                '' // ID товару (тільки якщо ви завантажували список товарів (не використовується в даному SDK))
            )
        ]
    ),
    'admin@example.com', // кому надсилати чек на пошту
    new \DigitSoft\Checkbox\Models\Receipts\Payments\Payments([ // оплати
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload( // безготівкова оплата
            400, // сума оплати 400 = 4 грн
            'bezgotivka', // текст оплати
            0, // code - не знаю для чого (видно пін код карти ^_^)
            '0000 0000 0000 0000' // номер картки
        ),
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload( // готівкова оплата
            4300, // сума оплати 4300 = 43 грн
            'nalichka' // текст оплати
        )
    ]),
    new \DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts( // знижки/надбавки на весь чек
        [
            new \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel(
                \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::TYPE_DISCOUNT, // знижка чи надбавка
                \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::MODE_VALUE, // по значенню чи по проценту
                200, // 2 грн  сума знижки/надбавки  200 = 2 грн
                $tax->code, // код податку (підготували вище)
                $taxCodes, // масив кодів податку (підготували вище)
                'total discount' // назва
            )
        ]
    ),
    'check header', // чек хидер
    'check footer', // чек футер
    '45435h543twrege' // баркод
);

$saleReceiptResult = $api->receipts()->createSell($receipt): \DigitSoft\Checkbox\Models\Receipts\Receipt; // виконуємо оплату
```
ще приклад
```php
$allTaxes = $api->taxes()->all();
$tax = $allTaxes->getTaxByLabel('Акцизний збір');
$goodTaxes = $allTaxes->getTaxesByLabel('ПДВ');
$taxCodes = [];

foreach ($goodTaxes->results as $goodTax) {
    $taxCodes[] = $goodTax->code;
}

$receipt = new \DigitSoft\Checkbox\Models\Receipts\SellReceipt(
    'Вася Пупкин',
    'Отдел продаж',
    new \DigitSoft\Checkbox\Models\Receipts\Goods\Goods(
        [
            new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel(
                new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel(
                    'vm-123', // good_id
                    5000, // 50 грн
                    'Биовак',
                    '',
                    '',
                    '',
                    '',
                    $goodTaxes
                ),
                1000,
                new \DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts(
                    [
                        new \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel(
                            \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::TYPE_DISCOUNT,
                            \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::MODE_VALUE,
                            100, // 1 грн
                            $tax->code,
                            $taxCodes,
                            'моя знижка'
                        )
                    ]
                ),
                $allTaxes->getTaxesByLabel('Акцизний збір'),
                false,
                0,
                ''
            ),
            new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel(
                new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel(
                    'vm-124', // good_id
                    2000, // 20 грн
                    'Биовак 2',
                    '',
                    '',
                    '',
                    '',
                    $goodTaxes
                ),
                2000, // 2 шт
                new \DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts(
                    [
                        new \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel(
                            \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::TYPE_EXTRA_CHARGE,
                            \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::MODE_VALUE,
                            200, // 2 грн
                            $tax->code,
                            $taxCodes,
                            'моя надбавка'
                        )
                    ]
                ),
                $allTaxes->getTaxesByLabel('Акцизний збір'),
                false,
                0,
                ''
            )
        ]
    ),
    'admin@gmail.com',
    new \DigitSoft\Checkbox\Models\Receipts\Payments\Payments([
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload(
            4700
        ),
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload(
            4700
        )
    ]),
    new \DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts(
        [
            new \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel(
                \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::TYPE_EXTRA_CHARGE,
                \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::MODE_VALUE,
                200, // 2 грн
                $tax->code,
                $taxCodes,
                'загальна надбавка'
            )
        ]
    )
);

$api->receipts()->createSell($receipt): \DigitSoft\Checkbox\Models\Receipts\Receipt;
```
```php
$api->receipts()->createService(
    new \DigitSoft\Checkbox\Models\Receipts\ServiceReceipt(
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload(5100)
    )
): \DigitSoft\Checkbox\Models\Receipts\Receipt // створюємо чек сервісного внесення коштів (готівкою)
```
```php
$api->receipts()->createService(
    new \DigitSoft\Checkbox\Models\Receipts\ServiceReceipt(
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload(1000)
    )
): \DigitSoft\Checkbox\Models\Receipts\Receipt // створюємо чек сервісного внесення коштів (картою)
```
```php
$api->receipts()->createService(
    new \DigitSoft\Checkbox\Models\Receipts\ServiceReceipt(
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload(-5100)
    )
): \DigitSoft\Checkbox\Models\Receipts\Receipt // створюємо чек сервісного внесення коштів (готівка) (знак мінус)
```
```php
$api->receipts()->createService(
    new \DigitSoft\Checkbox\Models\Receipts\ServiceReceipt(
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload(-1000)
    )
): \DigitSoft\Checkbox\Models\Receipts\Receipt // створюємо чек сервісного внесення коштів (картою) (знак мінус)
```

##### Рекомендації:

> всі операції обгортати в try catch

```php
try {

    // код для роботи з API тут

} catch (\DigitSoft\Checkbox\Exceptions\InvalidCredentialsException $err) {
    var_dump('creds err', $err->getMessage());
}  catch (\DigitSoft\Checkbox\Exceptions\EmptyResponseException $err) {
    var_dump('empty response', $err->getMessage(), $err->getTraceAsString());
} catch (\DigitSoft\Checkbox\Exceptions\ValidationException $err) {
    var_dump('valid err', $err->getMessage());
    var_dump('error detail', $err->getDetail());
} catch (\DigitSoft\Checkbox\Exceptions\NoActiveShiftException $err) {
    var_dump('no shift', $err->getMessage());
} catch (\DigitSoft\Checkbox\Exceptions\AlreadyOpenedShiftException $err) {
    var_dump('opened shift', $err->getMessage());
} catch (\Exception $err) {
    var_dump('default err', $err->getMessage());
}
```

##### Підключення класів з прикладів вище:

```php
use DigitSoft\Checkbox\Config;
use DigitSoft\Checkbox\CheckboxJsonApi;

use DigitSoft\Checkbox\Exceptions\ValidationException;
use DigitSoft\Checkbox\Exceptions\EmptyResponseException;
use DigitSoft\Checkbox\Exceptions\NoActiveShiftException;
use DigitSoft\Checkbox\Exceptions\InvalidCredentialsException;
use DigitSoft\Checkbox\Exceptions\AlreadyOpenedShiftException;

use DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams;
use DigitSoft\Checkbox\Models\Reports\ReportsQueryParams;
use DigitSoft\Checkbox\Models\Receipts\ReceiptsQueryParams;
use DigitSoft\Checkbox\Models\Reports\PeriodicalReportQueryParams;
use DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams;
use DigitSoft\Checkbox\Models\CashRegisters\CashRegistersQueryParams;

use DigitSoft\Checkbox\Models\Receipts\Goods\Goods;
use DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel;
use DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel;
use DigitSoft\Checkbox\Models\Receipts\SellReceipt;
use DigitSoft\Checkbox\Models\Receipts\ServiceReceipt;

use DigitSoft\Checkbox\Models\Receipts\Payments\Payments;
use DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload;
use DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload;

use DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts;
use DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel;
```

Without Docker
```
#validate composer json
composer check-composer

#static analyzes and codestyle
composer static

#run unit tests
composer unit-tests

#run all tests

composer all-tests
```

