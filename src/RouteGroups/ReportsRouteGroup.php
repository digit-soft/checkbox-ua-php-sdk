<?php

namespace DigitSoft\Checkbox\RouteGroups;

use DigitSoft\Checkbox\Models\Shifts\ZReport;
use DigitSoft\Checkbox\Models\Reports\Reports;
use DigitSoft\Checkbox\Mappers\Shifts\ZReportMapper;
use DigitSoft\Checkbox\Mappers\Reports\ReportsMapper;
use DigitSoft\Checkbox\Models\Reports\ReportsQueryParams;
use DigitSoft\Checkbox\Models\Reports\PeriodicalReportQueryParams;

class ReportsRouteGroup extends RouteGroup
{
    /**
     * Get all reports by query params.
     *
     * @param  \DigitSoft\Checkbox\Models\Reports\ReportsQueryParams $queryParams
     * @return \DigitSoft\Checkbox\Models\Reports\Reports|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all(ReportsQueryParams $queryParams): ?Reports
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getReports($queryParams),
        );

        return (new ReportsMapper)->jsonToObject($json);
    }

    /**
     * Create X report.
     *
     * @return \DigitSoft\Checkbox\Models\Shifts\ZReport|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createX(): ?ZReport
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->createXReport(),
        );

        return (new ZReportMapper())->jsonToObject($json);
    }

    /**
     * Get one Z report.
     *
     * @param  string $id
     * @return \DigitSoft\Checkbox\Models\Shifts\ZReport|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function one(string $id): ?ZReport
    {
        $json = $this->api->sendJsonRequestAuthorized(
            $this->routes->getReport($id),
        );

        return (new ZReportMapper)->jsonToObject($json);
    }

    /**
     * Get one Z report as TEXT.
     *
     * @param  string $id
     * @param  int    $printArea
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function oneAsText(string $id, int $printArea = 42): string
    {
        if ($printArea < 10 or $printArea > 250) {
            throw new \Exception('That print area is invalid');
        }

        return $this->api->sendJsonRequestAuthorized(
            $this->routes->getReportText($id, $printArea),
        );
    }

    /**
     * Get periodical report by query params.
     *
     * @param  \DigitSoft\Checkbox\Models\Reports\PeriodicalReportQueryParams $queryParams
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function onePeriodical(PeriodicalReportQueryParams $queryParams): string
    {
        return $this->api->sendJsonRequestAuthorized(
            $this->routes->getPeriodicalReport($queryParams),
            returnRaw: true
        );
    }
}
