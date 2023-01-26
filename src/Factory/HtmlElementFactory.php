<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Factory;

use Setono\HtmlElement\HtmlElement;
use Setono\HtmlElement\NodeInterface;

final class HtmlElementFactory implements HtmlElementFactoryInterface
{
    /**
     * @param array<string, array{attributes: array<string, string>}> $configuration
     */
    public function __construct(private readonly array $configuration)
    {
    }

    public function create(string $element, string|NodeInterface ...$children): HtmlElement
    {
        $htmlElement = new HtmlElement($element, ...$children);

        if (!isset($this->configuration[$element])) {
            return $htmlElement;
        }

        foreach ($this->configuration[$element]['attributes'] as $attribute => $value) {
            $htmlElement = $htmlElement->withAttribute($attribute, $value);
        }

        return $htmlElement;
    }
}
