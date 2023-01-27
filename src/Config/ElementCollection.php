<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Config;

/**
 * This collection represents all elements configured in the bundle configuration
 *
 * todo should we verify that all 'inherits' exist?
 */
final class ElementCollection
{
    /** @var array<string, Element> */
    private array $elements = [];

    /**
     * @param array<string, array{inherits?: string, tag?: string, attributes: array<string, string>}> $configuration
     */
    public function __construct(array $configuration)
    {
        foreach ($configuration as $name => $element) {
            $this->elements[$name] = new Element($name, $element);
        }
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
