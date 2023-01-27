<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Config;

/**
 * This is a DTO that represents an element defined in the configuration of the bundle
 */
final class Element
{
    public string $name;

    public ?string $tag;

    /**
     * Another element that this element inherits from
     */
    public ?string $inherits;

    /** @var array<string, string> */
    public array $attributes = [];

    /**
     * @param array{tag?: string, inherits?: string, attributes: array<string, string>} $element
     */
    public function __construct(string $name, array $element)
    {
        $this->name = $name;
        $this->tag = $element['tag'] ?? null;
        $this->inherits = $element['inherits'] ?? null;
        $this->attributes = $element['attributes'];
    }
}
