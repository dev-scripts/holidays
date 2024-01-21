<?php

namespace Spatie\Holidays\Countries;

use Carbon\CarbonImmutable;

class Australia extends Country
{
    public function countryCode(): string
    {
        return 'au';
    }

    protected function allHolidays(int $year): array
    {
        return array_merge([
            'New Year Day' => '01-01',
            'Australia Day' => '01-26',
            'Anzac Day' => '04-25',
            'Christmas Day' => '12-25',
        ], $this->variableHolidays($year));
    }

    /** @return array<string, CarbonImmutable> */
    protected function variableHolidays(int $year): array
    {
        $easter = CarbonImmutable::createFromTimestamp(easter_date($year))
            ->setTimezone('Australia/Sydney');

        return [
            'Good Friday' => $easter->subDays(2),
            'Easter Monday' => $easter->addDay(),
        ];
    }
}