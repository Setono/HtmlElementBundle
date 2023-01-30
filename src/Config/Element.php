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

    /** @var list<Attribute> */
    public array $attributes = [];

    /**
     * @param list<Attribute> $attributes
     */
    public function __construct(string $name, array $attributes, ?string $inherits = null, ?string $tag = null)
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->inherits = $inherits;
        $this->tag = $tag;
    }

    /**
     * @param array{tag?: string, inherits?: string, attributes: array<string, string>} $element
     */
    public static function fromArray(string $name, array $element): self
    {
        $attributes = [];

        foreach ($element['attributes'] as $attribute => $value) {
            $attributes[] = Attribute::fromArray([
                'name' => $attribute,
                'value' => $value,
            ]);
        }

        return new self($name, $attributes, $element['inherits'] ?? null, $element['tag'] ?? null);
    }
}
