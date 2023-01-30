<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Config;

/**
 * This collection represents all elements configured in the bundle configuration
 *
 * todo should we verify that all 'inherits' exist?
 * todo verify that we don't have cyclic 'inherits'
 */
final class ElementCollection
{
    /** @var array<string, Element> */
    private array $elements = [];

    /**
     * @param array<string, array{inherits?: string, tag?: string, attributes: array<string, string>}> $configuration
     */
    public static function fromArray(array $configuration): self
    {
        $obj = new self();

        foreach ($configuration as $name => $element) {
            $obj->add(Element::fromArray($name, $element));
        }

        return $obj;
    }

    public function add(Element $element): void
    {
        $this->elements[$element->name] = $element;
    }

    /**
     * @psalm-assert-if-true Element $this->elements[$name]
     */
    public function has(string $name): bool
    {
        return isset($this->elements[$name]);
    }

    public function get(string $name): Element
    {
        if (!$this->has($name)) {
            throw new \InvalidArgumentException(sprintf('No element with name %s exists', $name));
        }

        return $this->elements[$name];
    }
}
