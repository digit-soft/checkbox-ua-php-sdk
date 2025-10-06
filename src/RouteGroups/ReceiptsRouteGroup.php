<?php

namespace DigitSoft\Checkbox\RouteGroups;

use DigitSoft\Checkbox\Models\Receipts\Receipt;
use DigitSoft\Checkbox\Models\Receipts\Receipts;
use DigitSoft\Checkbox\Models\Receipts\SellReceipt;
use DigitSoft\Checkbox\Mappers\Receipts\ReceiptMapper;
use DigitSoft\Checkbox\Models\Receipts\ServiceReceipt;
use DigitSoft\Checkbox\Mappers\Receipts\ReceiptsMapper;
use DigitSoft\Checkbox\Mappers\Receipts\SellReceiptMapper;
use DigitSoft\Checkbox\Models\Receipts\ReceiptsQueryParams;
use DigitSoft\Checkbox\Mappers\Receipts\ServiceReceiptMapper;

class ReceiptsRouteGroup extends RouteGroup
{
    /**
     * Get receipts of the current shift or by the filters.
     *
     * Search by serial and fiscal numbers is not possible at the same time.
     *
     * If the cashier does not have an active shift, the search is performed by organization,
     * otherwise the search is performed by the cash register.
     *
     * @param  \DigitSoft\Checkbox\Models\Receipts\ReceiptsQueryParams|null $queryParams
     * @return \DigitSoft\Checkbox\Models\Receipts\Receipts|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all(?ReceiptsQueryParams $queryParams = null): ?Receipts
    {
        $queryParams = $queryParams ?? new ReceiptsQueryParams();

        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getReceipts($queryParams),
        );

        return (new ReceiptsMapper)->jsonToObject($json);
    }

    /**
     * Get a receipt.
     *
     * @param  string $id Receipt ID
     * @return \DigitSoft\Checkbox\Models\Receipts\Receipt|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function one(string $id): ?Receipt
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getReceipt($id),
        );

        return (new ReceiptMapper)->jsonToObject($json);
    }

    /**
     * Create a new sell receipt.
     *
     * @param  \DigitSoft\Checkbox\Models\Receipts\SellReceipt $receipt
     * @return \DigitSoft\Checkbox\Models\Receipts\Receipt|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createSell(SellReceipt $receipt): ?Receipt
    {
        $body = (new SellReceiptMapper)->objectToJson($receipt);
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->createSellReceipt(),
            'POST',
            $body
        );

        return (new ReceiptMapper)->jsonToObject($json);
    }

    /**
     * Create a service receipt.
     *
     * @param  \DigitSoft\Checkbox\Models\Receipts\ServiceReceipt $receipt
     * @return \DigitSoft\Checkbox\Models\Receipts\Receipt|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createService(ServiceReceipt $receipt): ?Receipt
    {
        $body = (new ServiceReceiptMapper)->objectToJson($receipt);
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->createServiceReceipt(),
            'POST',
            $body
        );

        return (new ReceiptMapper)->jsonToObject($json);
    }

    /**
     * Get one receipt as a PDF.
     *
     * @param  string $id Receipt ID
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function oneAsPdf(string $id): string
    {
        return $this->api->sendJsonRequest(
            $this->routes->getReceiptPdf($id),
            returnRaw: true
        );
    }

    /**
     * Get one receipt as HTML.
     *
     * @param  string $id Receipt ID
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function oneAsHtml(string $id): string
    {
        return $this->api->sendJsonRequest(
            $this->routes->getReceiptHtml($id),
            returnRaw: true
        );
    }

    /**
     * Get one receipt as plain TEXT.
     *
     * @param  string $id Receipt ID
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function oneAsText(string $id): string
    {
        return $this->api->sendJsonRequest(
            $this->routes->getReceiptText($id),
            returnRaw: true
        );
    }

    /**
     * Get one receipt as an image with QR code.
     *
     * @param  string $id Receipt ID
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function oneAsImageQrCode(string $id): string
    {
        $headers = [
            'Content-Type' => 'image/png',
        ];

        return $this->api->sendJsonRequest(
            $this->routes->getReceiptQrCodeImage($id),
            headers: $headers,
            returnRaw: true
        );
    }

    /**
     * Get one receipt as PNG image.
     *
     * @param  string $id Receipt ID
     * @param  int    $width
     * @param  int    $paperWidth
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function oneAsImagePng(string $id, int $width = 30, int $paperWidth = 58): string
    {
        $headers = [
            'Content-Type' => 'image/png',
        ];

        return $this->api->sendJsonRequest(
            $this->routes->getReceiptImagePng($id, $width, $paperWidth),
            headers: $headers,
            returnRaw: true
        );
    }

    /**
     * Get one receipt as PNG image.
     *
     * @param  string $id Receipt ID
     * @param  int    $width
     * @param  int    $paperWidth
     * @return string
     */
    public function oneAsImagePngLink(string $id, int $width = 30, int $paperWidth = 58): string
    {
        return $this->routes->getReceiptImagePng($id, $width, $paperWidth);
    }
}
