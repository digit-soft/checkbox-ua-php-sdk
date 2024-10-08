<?php

namespace DigitSoft\Checkbox\Models\Shifts;

class ShiftsQueryParams
{
    public const string STATUS_CREATED = 'CREATED';
    public const string STATUS_OPENING = 'OPENING';
    public const string STATUS_OPENED = 'OPENED';
    public const string STATUS_CLOSING = 'CLOSING';
    public const string STATUS_CLOSED = 'CLOSED';

    /** @var array<string> $statuses */
    public array $statuses = [];
    public bool $desc = false;
    public int $limit = 25;
    public int $offset = 0;

    private static array $allowedStatuses = [
        self::STATUS_CREATED,
        self::STATUS_OPENING,
        self::STATUS_OPENED,
        self::STATUS_CLOSING,
        self::STATUS_CLOSED
    ];

    /**
     * Constructor.
     *
     * @param  array<string> $statuses
     * @param  bool          $desc
     * @param  int           $limit
     * @param  int           $offset
     * @throws \Exception
     */
    public function __construct(
        array $statuses = [],
        bool $desc = false,
        int $limit = 25,
        int $offset = 0
    ) {
        if ($offset < 0) {
            throw new \Exception("Offset can't be less than 0");
        }
        if ($limit > 1000) {
            throw new \Exception("Limit can't be greater than 1000");
        }

        $this->statuses = $statuses;

        $this->validateStatuses();

        $this->offset = $offset;
        $this->limit = $limit;
        $this->desc = $desc;
    }

    /**
     * Validate statuses.
     *
     * @return void
     * @throws \Exception
     */
    private function validateStatuses(): void
    {
        foreach ($this->statuses as $status) {
            if (! in_array($status, static::$allowedStatuses, true)) {
                throw new \Exception('Status "' . $status . '" is not allowed');
            }
        }
    }
}
