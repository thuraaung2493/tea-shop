<?php

namespace App\ValueObjects;

class Price
{
    private function __construct(private readonly float $value)
    {
    }

    public static function from(float $value = 0)
    {
        return new static(round($value, 2));
    }

    public function value()
    {
        return $this->value;
    }

    public function formatted(): string
    {
        return number_format($this->value, 2) . " MMK";
    }
}
