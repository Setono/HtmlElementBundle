<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Config;

final class Attribute
{
    public function __construct(public readonly string $name, public readonly string $value, public readonly bool $overwrite = false)
    {
    }

    /**
     * @param array{name: string, value: string} $data
     */
    public static function fromArray(array $data): self
    {
        return new self($data['name'], $data['value']);
    }
}
