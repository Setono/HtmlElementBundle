<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Twig;

use Setono\HtmlElement\HtmlElement;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

final class Extension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('element', [Runtime::class, 'element'], ['is_safe' => ['html']]),
        ];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('add_class', [$this, 'addClass'], ['is_safe' => ['html']]),
        ];
    }

    public function addClass(HtmlElement $htmlElement, string ...$class): HtmlElement
    {
        return $htmlElement->withClass(...$class);
    }
}
