<?php

namespace Covid;

use Webmozart\Assert\Assert;

class ResultSorter
{
    private const AVALIABLE_COLUMNS = [
        'country',
        'cases',
        'todayCases',
        'deaths',
        'todayDeaths',
        'recovered',
        'active',
        'critical',
        'casesPerOneMillion',
        'totalTests',
        'testsPerOneMillion',
    ];

    public function sort(array $data, string $columnName): array
    {
        if (!is_numeric(array_keys($data))) {
            return $data;
        }

        Assert::inArray($columnName, self::AVALIABLE_COLUMNS, "Unknown column name: $columnName");

        array_multisort(
            array_column($data, $columnName),
            SORT_DESC,
            $data
        );

        return $data;
    }
}
