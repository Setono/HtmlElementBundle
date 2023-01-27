<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class Extension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('element', [Runtime::class, 'element'], ['is_safe' => ['html']]),
        ];
    }
}
