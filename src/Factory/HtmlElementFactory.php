<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Factory;

use Setono\HtmlElement\HtmlElement;
use Setono\HtmlElement\NodeInterface;
use Setono\HtmlElementBundle\Config\Element;
use Setono\HtmlElementBundle\Config\ElementCollection;

final class HtmlElementFactory implements HtmlElementFactoryInterface
{
    public function __construct(private readonly ElementCollection $elementCollection)
    {
    }

    public function create(string $element, string|NodeInterface ...$children): HtmlElement
    {
        if (!$this->elementCollection->has($element)) {
            return new HtmlElement($element, ...$children);
        }

        $configElement = $this->elementCollection->get($element);

        $htmlElement = null === $configElement->tag ? new HtmlElement($element, ...$children) : new HtmlElement($configElement->tag, ...$children);

        foreach ($this->getAncestors($configElement) as $parent) {
            foreach ($parent->attributes as $attribute => $value) {
                $htmlElement = $htmlElement->withAttribute($attribute, $value);
            }
        }

        foreach ($configElement->attributes as $attribute => $value) {
            $htmlElement = $htmlElement->withAttribute($attribute, $value);
        }

        return $htmlElement;
    }

    /**
     * This method will return an ordered list of parents that the element we are creating should inherit from.
     *
     * @return array<array-key, Element>
     */
    private function getAncestors(Element $configElement): array
    {
        $ancestors = [];

        while (null !== $configElement->inherits) {
            if (!$this->elementCollection->has($configElement->inherits)) {
                break;
            }

            $configElement = $this->elementCollection->get($configElement->inherits);

            array_unshift($ancestors, $configElement);
        }

        return $ancestors;
    }
}
