<?php

namespace PH\Date\Domain;

use DateTimeImmutable;
use Exception;

final class Date
{
    private DateTimeImmutable $date;

    /**
     * @throws Exception
     */
    private function __construct(string $date)
    {
        $this->date = new DateTimeImmutable($date);
    }

    /**
     * @throws Exception
     */
    public static function createFromString(string $date): self
    {
        return new self($date);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->date->format('Y-m-d\TH:i:sT');
    }

    /**
     * @return DateTimeImmutable
     */
    public function date(): DateTimeImmutable
    {
        return $this->date;
    }
}