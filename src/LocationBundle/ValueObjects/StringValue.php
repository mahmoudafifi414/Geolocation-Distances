<?php

namespace LocationBundle\ValueObjects;

abstract class StringValue
{
    /**
     * @param string $value
     */
    public function __construct(private readonly string $value)
    {
    }

    /**
     * @return  string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return  static
     */
    public static function of(string $value): static
    {
        return new static($value);
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
