<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Factory;

use Setono\HtmlElement\HtmlElement;
use Setono\HtmlElement\NodeInterface;

interface HtmlElementFactoryInterface
{
    public function create(string $element, string|NodeInterface ...$children): HtmlElement;
}
