<?php

namespace DigitSoft\Checkbox\Models\Reports;

class ReportsQueryParams
{
    public ?string $from_date;
    public ?string $to_date;
    public array $shift_id;
    public ?bool $is_z_report = null;
    public bool $desc = false;
    public int $limit = 25;
    public int $offset = 0;

    /**
     * Constructor
     *
     * @param  string|null   $from_date
     * @param  string|null   $to_date
     * @param  array<string> $shift_id
     * @param  bool|null     $is_z_report
     * @param  bool          $desc
     * @param  int           $limit
     * @param  int           $offset
     *
     * @throws \Exception
     */
    public function __construct(
        ?string $from_date = null,
        ?string $to_date = null,
        array $shift_id = [],
        ?bool $is_z_report = null,
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

        $this->from_date = $from_date;
        $this->to_date = $to_date;

        if (! isset($this->from_date) && ! isset($this->to_date)) {
            $this->shift_id = $shift_id;
        }

        if (isset($is_z_report)) {
            $this->is_z_report = filter_var($is_z_report, FILTER_VALIDATE_BOOLEAN);
        }

        $this->desc = $desc;
        $this->limit = $limit;
        $this->offset = $offset;
    }
}
