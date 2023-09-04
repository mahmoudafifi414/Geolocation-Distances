<?php

namespace LocationBundle\ValueObjects;

abstract class FloatValue
{
    /**
     * @param float $value
     */
    public function __construct(private readonly float $value)
    {
    }

    /**
     * @return  float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return  static
     */
    public static function of(float $value): static
    {
        return new static($value);
    }

    public function jsonSerialize(): float
    {
        return $this->value;
    }
}
