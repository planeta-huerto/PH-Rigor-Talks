<?php
declare(strict_types=1);

namespace PH\Application;

use PH\Domain\Temperature;

final class QueryTempService
{
    private $tempSource;

    public function __construct($tempSource)
    {
        $this->tempSource = $tempSource;
    }

    public function __invoke()
    {
        return Temperature::take($this->tempSource->getTemperature());
    }
}