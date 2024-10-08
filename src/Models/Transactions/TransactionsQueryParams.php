<?php

namespace DigitSoft\Checkbox\Models\Transactions;

class TransactionsQueryParams
{
    public const string STATUS_CREATED = 'CREATED';
    public const string STATUS_PENDING = 'PENDING';
    public const string STATUS_SIGNED = 'SIGNED';
    public const string STATUS_DELIVERED = 'DELIVERED';
    public const string STATUS_DONE = 'DONE';
    public const string STATUS_ERROR = 'ERROR';

    public const string TYPE_SHIFT_OPEN = 'SHIFT_OPEN';
    public const string TYPE_X_REPORT = 'X_REPORT';
    public const string TYPE_Z_REPORT = 'Z_REPORT';
    public const string TYPE_PING = 'PING';
    public const string TYPE_RECEIPT = 'RECEIPT';
    public const string TYPE_LAST_RECEIPT = 'LAST_RECEIPT';
    public const string TYPE_GO_OFFLINE = 'GO_OFFLINE';
    public const string TYPE_ASK_OFFLINE_CODES = 'ASK_OFFLINE_CODES';
    public const string TYPE_GO_ONLINE = 'GO_ONLINE';
    public const string TYPE_DEL_LAST_RECEIPT = 'DEL_LAST_RECEIPT';

    public array $statuses;
    public array $types;
    public int $limit;
    public int $offset;

    protected static array $allowedStatuses = [
        self::STATUS_CREATED,
        self::STATUS_PENDING,
        self::STATUS_SIGNED,
        self::STATUS_DELIVERED,
        self::STATUS_DONE,
        self::STATUS_ERROR
    ];

    protected static array $allowedTypes = [
        self::TYPE_SHIFT_OPEN,
        self::TYPE_X_REPORT,
        self::TYPE_Z_REPORT,
        self::TYPE_PING,
        self::TYPE_RECEIPT,
        self::TYPE_LAST_RECEIPT,
        self::TYPE_GO_OFFLINE,
        self::TYPE_ASK_OFFLINE_CODES,
        self::TYPE_GO_ONLINE,
        self::TYPE_DEL_LAST_RECEIPT
    ];

    /**
     * Constructor
     *
     * @param  array<string> $statuses
     * @param  array<string> $types
     * @param  int           $limit
     * @param  int           $offset
     * @throws \Exception
     */
    public function __construct(
        array $statuses = [],
        array $types = [],
        int $limit = 25,
        int $offset = 0
    ) {
        if ($offset < 0) {
            throw new \Exception('Offset cant be lower then 0');
        }

        if ($limit > 1000) {
            throw new \Exception('Limit cant be more then 1000');
        }

        $this->statuses = $statuses;
        $this->types = $types;

        $this->validateStatuses();
        $this->validateTypes();

        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * Validate statuses.
     *
     * @return void
     * @throws \Exception
     */
    protected function validateStatuses(): void
    {
        $diff = array_diff(array_unique($this->statuses), static::$allowedStatuses);
        if (! empty($diff)) {
            $statusesInvalid = implode(', ', $diff);
            throw new \Exception('Statuses "' . $statusesInvalid . '" are not allowed.');
        }
    }

    /**
     * Validate types.
     *
     * @return void
     * @throws \Exception
     */
    protected function validateTypes(): void
    {
        $diff = array_diff(array_unique($this->types), static::$allowedTypes);
        if (! empty($diff)) {
            $typesInvalid = implode(', ', $diff);
            throw new \Exception('Types "' . $typesInvalid . '" are not allowed.');
        }
    }
}
