<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Twig;

use Setono\HtmlElement\HtmlElement;
use Setono\HtmlElement\NodeInterface;
use Setono\HtmlElementBundle\Factory\HtmlElementFactoryInterface;
use Twig\Extension\RuntimeExtensionInterface;

final class Runtime implements RuntimeExtensionInterface
{
    public function __construct(private readonly HtmlElementFactoryInterface $htmlElementFactory)
    {
    }

    public function element(string $element, string|NodeInterface ...$children): HtmlElement
    {
        return $this->htmlElementFactory->create($element, ...$children);
    }
}
