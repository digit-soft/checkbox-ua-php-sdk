<?php

declare(strict_types=1);

namespace DigitSoft\Checkbox\Tests\Mappers;

use DigitSoft\Checkbox\Mappers\Shifts\ZReportMapper;
use PHPUnit\Framework\TestCase;

class GetReportTest extends TestCase
{
    /** @var  string $jsonString */
    private $jsonString;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->jsonString = '{
           "id":"c15dd25d-6c2f-465c-901d-fa974ecc8e19",
           "serial":3,
           "is_z_report":false,
           "payments":[
              {
                 "id":"50ceebcc-c705-4d4d-b104-d1b0bdcfa65e",
                 "type":"CARD",
                 "label":"beznalichka",
                 "sell_sum":5100,
                 "return_sum":0,
                 "service_in":0,
                 "service_out":0
              },
              {
                 "id":"f1763340-4008-4035-bf65-974451fc2e6f",
                 "type":"CASH",
                 "label":"nalichka",
                 "sell_sum":8900,
                 "return_sum":0,
                 "service_in":0,
                 "service_out":0
              }
           ],
           "taxes":[
              {
                 "id":"ee642781-d36e-4d67-a95f-bc8f5cb10cac",
                 "code":1234567891,
                 "label":"Побори",
                 "symbol":"Я",
                 "rate":12.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-22T15:42:36+00:00"
              },
              {
                 "id":"a11ad9ce-d8f6-4c30-94e3-6051f62e8733",
                 "code":1234567890,
                 "label":"ПДВ",
                 "symbol":"A",
                 "rate":5.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-07T11:22:07+00:00"
              },
              {
                 "id":"4a07119e-d861-44ac-9119-ea19f2036b44",
                 "code":123123,
                 "label":"4",
                 "symbol":"Д",
                 "rate":5.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-22T16:14:11+00:00"
              },
              {
                 "id":"291d22df-e9e9-4a95-b82b-26ec81bbab45",
                 "code":4,
                 "label":"ПДВ",
                 "symbol":"В",
                 "rate":7.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-26T10:53:33+00:00"
              },
              {
                 "id":"d8e0f50a-6601-4b10-abd7-651a78deff86",
                 "code":2,
                 "label":"Акцизний збір",
                 "symbol":"Г",
                 "rate":0.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-26T10:53:41+00:00"
              },
              {
                 "id":"d266c743-8003-4b60-aa41-e6475fe26bd1",
                 "code":3,
                 "label":"Без ПДВ",
                 "symbol":"Е",
                 "rate":0.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-26T10:54:08+00:00"
              },
              {
                 "id":"5b4928b1-5824-41e3-8016-46b6858d35d8",
                 "code":1,
                 "label":"ПДВ А",
                 "symbol":"Є",
                 "rate":20.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-26T10:54:18+00:00"
              },
              {
                 "id":"77902050-d074-40cf-b242-4d7f7c1cf52b",
                 "code":5,
                 "label":"Не є об\'єктом оподаткування",
                 "symbol":"И",
                 "rate":0.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-26T10:54:47+00:00"
              },
              {
                 "id":"6496767c-376d-4193-9c25-aa832806d312",
                 "code":1230321,
                 "label":"Без ПДВ",
                 "symbol":"Б",
                 "rate":0.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-08T16:22:21+00:00"
              },
              {
                 "id":"5785da1b-9b33-482b-8dbd-58cad68f3a57",
                 "code":123124,
                 "label":"1",
                 "symbol":"Ж",
                 "rate":1.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-08T16:24:47+00:00"
              },
              {
                 "id":"7701e59e-fd49-4c67-8848-f1820af09c36",
                 "code":33333,
                 "label":"2",
                 "symbol":"З",
                 "rate":1.0,
                 "sell_sum":0,
                 "return_sum":0,
                 "sales_turnover":0,
                 "returns_turnover":0,
                 "created_at":"2020-10-08T16:25:03+00:00"
              }
           ],
           "sell_receipts_count":2,
           "return_receipts_count":0,
           "transfers_count":0,
           "transfers_sum":0,
           "created_at":"2020-11-04T13:36:09.723948+00:00",
           "updated_at":null
        }';
    }

    public function testMapShiftWithNull(): void
    {
        $this->assertNull(
            (new ZReportMapper())->jsonToObject(null)
        );
    }

    public function testMapGetShiftWithJson(): void
    {
        $jsonResponse = json_decode($this->jsonString, true);

        $mapped = (new ZReportMapper())->jsonToObject($jsonResponse);

        $this->assertEquals(
            'c15dd25d-6c2f-465c-901d-fa974ecc8e19',
            $mapped->id
        );
        $this->assertEquals(
            '50ceebcc-c705-4d4d-b104-d1b0bdcfa65e',
            $mapped->payments->payments[0]->id
        );
        $this->assertEquals(
            'ee642781-d36e-4d67-a95f-bc8f5cb10cac',
            $mapped->taxes->taxes[0]->id
        );
    }
}
