[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![PHP >=8.3](https://img.shields.io/badge/php-%3E=_8.3-orange.svg?style=flat-square)](https://github.com/digit-soft/checkbox-ua-php-sdk)

# checkbox-ua-php-sdk
### PHP SDK для работи з Checkbox (Україна)

##### Примітка:

> В даному SDK реализовані тільки функції онлайн режиму (офлайн ніт)

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

>адреса продакшн серверу http://api.checkbox.in.ua<br/>
>адреса тестового серверу http://dev-api.checkbox.in.ua<br/>
>версія API - v1

```php
$config = new \DigitSoft\Checkbox\Config([
    \DigitSoft\Checkbox\Config::API_URL => 'https://dev-api.checkbox.in.ua/api/v1',
    \DigitSoft\Checkbox\Config::LOGIN => 'логін касира',
    \DigitSoft\Checkbox\Config::PASSWORD => 'пароль касира', //or
    \DigitSoft\Checkbox\Config::PINCODE => 02301230440,
    \DigitSoft\Checkbox\Config::LICENSE_KEY => 'ключ лицензії каси'
]);
```

##### Логін кассира:

```php
$api = new \DigitSoft\Checkbox\CheckboxJsonApi($config);
$api->signInCashier();
```
##### Логаут кассира:
```php
$api->signOutCashier();
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
$api->getCashierProfile() : \DigitSoft\Checkbox\Models\Cashier\Cashier // возвращает профиль кассира
```
##### shifts (зміни):
```php
$api->getCashierShift() : \DigitSoft\Checkbox\Models\Shifts\Shift // возвращает текущую смену кассира
```
```php
$api->getShift('ID зміни') : \DigitSoft\Checkbox\Models\Shifts\Shift // возвращает смену по ид
```
```php
$api->getShifts() : \DigitSoft\Checkbox\Models\Shifts\Shifts // возвращает смены
```
або
```php
$api->getShifts(
    new \DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams(
        [
            \DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams::STATUS_CLOSED,
            \DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams::STATUS_OPENED
        ], // статуси змін
        false, // desc - сортування (false or true)
        2, // limit
        0 // offset
    )
): \DigitSoft\Checkbox\Models\Shifts\Shifts // возвращает смены с учетом фильтра
```
```php
$api->createShift() : \DigitSoft\Checkbox\Models\Shifts\CreateShift // создает смену
```
```php
$api->closeShift() : \DigitSoft\Checkbox\Models\Shifts\CloseShift // закрывает смену
```
##### cash registers (пРРО):
```php
$api->getCashRegisters() : \DigitSoft\Checkbox\Models\CashRegisters\CashRegisters // возвращает кассовые регистраторы
```
или
```php
$api->getCashRegisters(
    new \DigitSoft\Checkbox\Models\CashRegisters\CashRegistersQueryParams(
        true, // inUse - используется или нет (true or false)
        3, // limit
        0 // offset
    )
) : \DigitSoft\Checkbox\Models\CashRegisters\CashRegisters // возвращает кассовые регистраторы по фильтру
```
```php
$api->getCashRegister('ид кассы') : \DigitSoft\Checkbox\Models\CashRegisters\CashRegister // возвращает кассу по айди
```
```php
$api->getCashRegisterInfo() : \DigitSoft\Checkbox\Models\CashRegisters\CashRegisterInfo // возвращает информацию текущей кассы
```
##### taxes (налоги):
```php
$api->getAllTaxes() : \DigitSoft\Checkbox\Models\Receipts\Taxes\GoodTaxes // возвращает все налоги
```
##### transactions (транзакции):
```php
$api->getTransactions(
    new \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams(
        [
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::STATUS_CREATED,
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::STATUS_DONE,
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::STATUS_SIGNED
        ], // статусы транзакции
        [
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::TYPE_RECEIPT,
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::TYPE_SHIFT_OPEN,
            \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams::TYPE_Z_REPORT
        ], // типы транзакций
        2, // limit
        0 // offset
    )
) : \DigitSoft\Checkbox\Models\Transactions\Transactions // возвращает транзакции по фильтру
```
```php
$api->getTransaction('ид транзакции') : \DigitSoft\Checkbox\Models\Transactions\Transaction // возвращает транзакцию по айди
```
```php
$api->updateTransaction(
    'ид транзакции',
    base64_encode('request_signature')
) : \DigitSoft\Checkbox\Models\Transactions\Transaction // меняет request_signature у транзакции, работает только если у транзакции статус PENDING
```
##### reports (отчеты):
```php
$api->createXReport() : \DigitSoft\Checkbox\Models\Shifts\ZReport // создает х отчет
```
```php
$api->getReport('ид отчета') : \DigitSoft\Checkbox\Models\Shifts\ZReport // возвращает данные отчета по айди
```
```php
$api->getReportText('ид отчета') : string // возвращает данные отчета по айди в виде текста
```
или
```php
$api->getReportText('ид отчета', 60) : string // возвращает данные отчета по айди в виде текста, с указанием ширины текста
```
```php
$api->getPeriodicalReport(
    new \DigitSoft\Checkbox\Models\Reports\PeriodicalReportQueryParams(
        '2020-10-27 00:00:00', // дата с
        '2020-11-04 13:15:00', // дата по
        60 // ширина текста
    )
) : string // возвращает данные отчета за период по фильру
```
```php
$api->getReports(
    new \DigitSoft\Checkbox\Models\Reports\ReportsQueryParams(
        '2020-10-27 00:00:00', // дата с
        '2020-11-04 13:15:00', // дата по
        [], // массив ид смен
        false, // is_z_report (true or false)
        true, // desc - сортировка (false or true)
        3, // limit
        0 // offset
    )
) : \DigitSoft\Checkbox\Models\Reports\Reports // возвращает отчеты по фильтру
```
##### receipts (чеки):
```php
$api->getReceipts() : \DigitSoft\Checkbox\Models\Receipts\Receipts // возвращает чеки
```
```php
$api->getReceipts(
    new \DigitSoft\Checkbox\Models\Receipts\ReceiptsQueryParams(
        '', // fiscal code
        '', // serial
        false, // desc - сортировка (false or true)
        2, // limit
        0 // offset
    )
) : \DigitSoft\Checkbox\Models\Receipts\Receipts // возвращает чеки по фильтру
```
```php
$api->getReceipt('ид чека') : \DigitSoft\Checkbox\Models\Receipts\Receipt // возвращает чек по айди
```
```php
$api->getReceiptPdf('ид чека') : pdf // возвращает чек по айди в виде пдф
```
```php
$api->getReceiptHtml('ид чека') : string // возвращает чек по айди в виде html
```
```php
$api->getReceiptText('ид чека') : string // возвращает чек по айди в виде текста
```
```php
$api->getReceiptQrCodeImage('ид чека') : string // возвращает чек по айди в виде qr-кода
```
или
```php
// пример с отображением qr-кода
$rawImageContent = $api->getReceiptQrCodeImage('ид чека');
echo '<img src="data:image/png;base64,' . base64_encode($rawImageContent) . '"/>';
```
###### чек продажи:
```php
$receipt = new \DigitSoft\Checkbox\Models\Receipts\SellReceipt(
    'Вася Пупкин', // кассир
    'Отдел продаж', // отдел
    new \DigitSoft\Checkbox\Models\Receipts\Goods\Goods(
        [
            new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel( // товар 1
                new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel(
                    'vm-123', // good_id
                    50 * 100, // 50 грн
                    'Биовак' // название товара
                ),
                1 * 1000 // кол-во товара  1 шт
            ),
            new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel( // товар 2
                new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel(
                    'vm-124', // good_id
                    20 * 100, // 20 грн
                    'Биовак 2' // название товара
                ),
                2 * 1000 // кол-во товара 2 шт
            )
        ]
    ),
    'admin@gmail.com', // кому отправлять чек по почте
    new \DigitSoft\Checkbox\Models\Receipts\Payments\Payments([
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload( // безналичная оплата
            40 * 100 // 40 грн
        ),
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload( // наличная оплата
            50 * 100 // 50 грн
        )
    ])
);

$api->createSellReceipt($receipt): \DigitSoft\Checkbox\Models\Receipts\Receipt; // выполняем оплату
```
более сложная оплата:
```php
$allTaxes = $api->getAllTaxes(); // получили все налоги
$tax = $allTaxes->getTaxByLabel('Акцизний збір'); // получили один налог по лейбл
$goodTaxes = $allTaxes->getTaxesByLabel('ПДВ'); // получили массив налогов по лейбл
$taxCodes = [];

// подготавливаем массив кодов налогов
foreach ($goodTaxes->results as $goodTax) {
    $taxCodes[] = $goodTax->code;
}

$receipt = new \DigitSoft\Checkbox\Models\Receipts\SellReceipt(
    'Вася Пупкин', // имя кассира
    'Отдел продаж', // отдел
    new \DigitSoft\Checkbox\Models\Receipts\Goods\Goods( // товары
        [
            new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel(
                new \DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel(
                    'vm-123', // good_id айди товара
                    5000, // 50 грн  цена 100 = 1 грн
                    'Биовак', // название
                    '5р47ле78675е3', // баркод
                    'хидер', // хидер
                    'футер', // футер
                    '', // ktzed
                    $goodTaxes // налоги товара
                ),
                1000, // кол-во 1000 = 1 шт
                new \DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts( // скидки или надбавки
                    [
                        new \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel(
                            \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::TYPE_DISCOUNT, // скидка или надбавка
                            \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::MODE_VALUE, // по значению или по проценту
                            100, // 1 грн  сумма скидки/надбавки  100 = 1 грн
                            0, // сумма (не используется в данном sdk)
                            $tax->code, // код налога (подготовили выше)
                            $taxCodes, // массив кодов налога (подготовили выше)
                            'one good discount' // название
                        )
                    ]
                ),
                $allTaxes->getTaxesByLabel('Акцизний збір'), // налоги товара
                false, // возврат товара (false or true)
                0, // сумма (не используется в данном sdk)
                '' // айди товара (только если вы загружали список товарв (не используется в данном sdk))
            )
        ]
    ),
    'admin@gmail.com', // кому отправлять чек по почте
    new \DigitSoft\Checkbox\Models\Receipts\Payments\Payments([ // оплаты
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload( // безналичная оплата
            400, // сумма оплаты 400 = 4 грн
            'beznalichka', // текст оплаты
            0, // code - не знаю для чего (видимо пин код карты)
            '0000 0000 0000 0000' // номер карты
        ),
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload( // наличная оплата
            4300, // сумма оплаты 4300 = 43 грн
            'nalichka' // текст оплаты
        )
    ]),
    new \DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts( // скидки/надбавки на весь чек
        [
            new \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel(
                \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::TYPE_DISCOUNT, // скидка или надбавка
                \DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel::MODE_VALUE, // по значению или по проценту
                200, // 2 грн  сумма скидки/надбавки  200 = 2 грн
                0, // сумма (не используется в данном sdk)
                $tax->code, // код налога (подготовили выше)
                $taxCodes, // массив кодов налога (подготовили выше)
                'total discount' // название
            )
        ]
    ),
    'check header', // чек хидер
    'check footer', // чек футер
    '45435h543twrege' // баркод
);

$saleReceiptResult = $api->createSellReceipt($receipt): \DigitSoft\Checkbox\Models\Receipts\Receipt; // выполняем оплату
```
еще пример
```php
$allTaxes = $api->getAllTaxes();
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
                            0,
                            $tax->code,
                            $taxCodes,
                            'моя скидка'
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
                            0,
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
                0,
                $tax->code,
                $taxCodes,
                'общая надбавка'
            )
        ]
    )
);

$api->createSellReceipt($receipt): \DigitSoft\Checkbox\Models\Receipts\Receipt;
```
```php
$api->createServiceReceipt(
    new \DigitSoft\Checkbox\Models\Receipts\ServiceReceipt(
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload(5100)
    )
): \DigitSoft\Checkbox\Models\Receipts\Receipt // создаем чек сервисного внесения денег (наличкой)
```
```php
$api->createServiceReceipt(
    new \DigitSoft\Checkbox\Models\Receipts\ServiceReceipt(
        new \DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload(1000)
    )
): \DigitSoft\Checkbox\Models\Receipts\Receipt // создаем чек сервисного внесения денег (картой)
```
```php
$api->createServiceReceipt(
    new \DigitSoft\Checkbox\Models\Receipts\ServiceReceipt(
        new new \DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload(-5100)
    )
): \DigitSoft\Checkbox\Models\Receipts\Receipt // создаем чек сервисного вынесения денег (наличкой) (знак минус)
```
```php
$api->createServiceReceipt(
    new \DigitSoft\Checkbox\Models\Receipts\ServiceReceipt(
        new new \DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload(-1000)
    )
): \DigitSoft\Checkbox\Models\Receipts\Receipt // создаем чек сервисного вынесения денег (картой) (знак минус)
```

##### Рекомендации:

> всі операції обгортати в try catch

```php
try {

    // тут все делаем

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

##### подключение всех неймспейсов из примеров:

```php
use DigitSoft\Checkbox\CheckboxJsonApi;
use DigitSoft\Checkbox\Config;
use DigitSoft\Checkbox\Exceptions\InvalidCredentialsException;
use DigitSoft\Checkbox\Exceptions\ValidationException;
use DigitSoft\Checkbox\Exceptions\NoActiveShiftException;
use DigitSoft\Checkbox\Exceptions\AlreadyOpenedShiftException;
use DigitSoft\Checkbox\Exceptions\EmptyResponseException;
use DigitSoft\Checkbox\Models\CashRegisters\CashRegistersQueryParams;
use DigitSoft\Checkbox\Models\Shifts\ShiftsQueryParams;
use DigitSoft\Checkbox\Models\Receipts\ReceiptsQueryParams;
use DigitSoft\Checkbox\Models\Receipts\Discounts\Discounts;
use DigitSoft\Checkbox\Models\Receipts\Discounts\DiscountModel;
use DigitSoft\Checkbox\Models\Receipts\SellReceipt;
use DigitSoft\Checkbox\Models\Receipts\Payments\Payments;
use DigitSoft\Checkbox\Models\Receipts\Payments\CardPaymentPayload;
use DigitSoft\Checkbox\Models\Receipts\Payments\CashPaymentPayload;
use DigitSoft\Checkbox\Models\Receipts\ServiceReceipt;
use DigitSoft\Checkbox\Models\Reports\PeriodicalReportQueryParams;
use DigitSoft\Checkbox\Models\Reports\ReportsQueryParams;
use DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams;
use DigitSoft\Checkbox\Models\Receipts\Goods\Goods;
use DigitSoft\Checkbox\Models\Receipts\Goods\GoodItemModel;
use DigitSoft\Checkbox\Models\Receipts\Goods\GoodModel;
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

