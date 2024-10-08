<?php

namespace DigitSoft\Checkbox\RouteGroups;

use DigitSoft\Checkbox\Models\Transactions\Transaction;
use DigitSoft\Checkbox\Models\Transactions\Transactions;
use DigitSoft\Checkbox\Mappers\Transactions\TransactionMapper;
use DigitSoft\Checkbox\Mappers\Transactions\TransactionsMapper;
use DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams;

class TransactionsRouteGroup extends RouteGroup
{
    /**
     * Get all transactions by query params.
     *
     * @param  \DigitSoft\Checkbox\Models\Transactions\TransactionsQueryParams $queryParams
     * @return \DigitSoft\Checkbox\Models\Transactions\Transactions|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all(TransactionsQueryParams $queryParams): ?Transactions
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getTransactions($queryParams),
        );

        return (new TransactionsMapper)->jsonToObject($json);
    }

    /**
     * Get one transaction.
     *
     * @param  string $id
     * @return \DigitSoft\Checkbox\Models\Transactions\Transaction|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function one(string $id): ?Transaction
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getTransaction($id),
        );

        return (new TransactionMapper)->jsonToObject($json);
    }

    /**
     * Update a transaction.
     *
     * @param  string $id
     * @param  string $requestSignature
     * @return \DigitSoft\Checkbox\Models\Transactions\Transaction|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @deprecated Not used in latest API docs
     */
    public function update(string $id, string $requestSignature): ?Transaction
    {
        $body = [
            'request_signature' => $requestSignature,
        ];
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->updateTransaction($id),
            'PATCH',
            $body
        );

        return (new TransactionMapper)->jsonToObject($json);
    }
}
