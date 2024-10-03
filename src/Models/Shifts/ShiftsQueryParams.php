<?php

namespace DigitSoft\Checkbox\Models\Shifts;

class ShiftsQueryParams
{
    /** @var array<string> $statuses */
    public $statuses;
    /** @var bool $desc */
    public $desc;
    /** @var int $limit */
    public $limit;
    /** @var int $offset */
    public $offset;
    /** @var array<string> $allowedStatuses */
    private $allowedStatuses = [];

    public const STATUS_CREATED = 'CREATED';
    public const STATUS_OPENING = 'OPENING';
    public const STATUS_OPENED = 'OPENED';
    public const STATUS_CLOSING = 'CLOSING';
    public const STATUS_CLOSED = 'CLOSED';

    /**
     * Constructor
     *
     * @param array<string> $statuses
     * @param bool $desc
     * @param int $limit
     * @param int $offset
     *
     */
    public function __construct(
        array $statuses = [],
        bool $desc = false,
        int $limit = 25,
        int $offset = 0
    ) {
        if ($offset < 0) {
            throw new \Exception('Offset cant be lower then 0');
        }

        if ($limit > 1000) {
            throw new \Exception('Limit cant be more then 1000');
        }

        $this->initAllowedStatuses();

        $this->statuses = $statuses;

        $this->validateStatuses();

        $this->offset = $offset;
        $this->limit = $limit;
        $this->desc = $desc;
    }

    private function initAllowedStatuses(): void
    {
        $this->allowedStatuses = [
            self::STATUS_CREATED,
            self::STATUS_OPENING,
            self::STATUS_OPENED,
            self::STATUS_CLOSING,
            self::STATUS_CLOSED
        ];
    }

    private function validateStatuses(): void
    {
        foreach ($this->statuses as $status) {
            if (!in_array($status, $this->allowedStatuses)) {
                throw new \Exception('Status "' . $status . '" is not allowed');
            }
        }
    }
}
