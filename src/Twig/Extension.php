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
            new TwigFilter('as_tag', [$this, 'asTag'], ['is_safe' => ['html']]),
            new TwigFilter('add_attribute', [$this, 'addAttribute'], ['is_safe' => ['html']]),
            new TwigFilter('add_class', [$this, 'addClass'], ['is_safe' => ['html']]),
            new TwigFilter('remove_class', [$this, 'removeClass'], ['is_safe' => ['html']]),
        ];
    }

    public function asTag(HtmlElement $htmlElement, string $tag): HtmlElement
    {
        return $htmlElement->withTag($tag);
    }

    public function addAttribute(HtmlElement $htmlElement, string $attribute, string $value = null): HtmlElement
    {
        return $htmlElement->withAttribute($attribute, $value);
    }

    public function addClass(HtmlElement $htmlElement, string ...$classes): HtmlElement
    {
        foreach ($classes as $class) {
            $htmlElement = $htmlElement->withClass($class);
        }

        return $htmlElement;
    }

    public function removeClass(HtmlElement $htmlElement, string ...$classes): HtmlElement
    {
        foreach ($classes as $class) {
            $htmlElement = $htmlElement->withoutClass($class);
        }

        return $htmlElement;
    }
}
