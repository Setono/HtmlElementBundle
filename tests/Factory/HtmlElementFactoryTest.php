<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Tests\Factory;

use PHPUnit\Framework\TestCase;
use Setono\HtmlElementBundle\Config\ElementCollection;
use Setono\HtmlElementBundle\Factory\HtmlElementFactory;
use Setono\HtmlElementBundle\Factory\HtmlElementFactoryInterface;

/**
 * @covers \Setono\HtmlElementBundle\Factory\HtmlElementFactory
 */
final class HtmlElementFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_html_element(): void
    {
        $h1 = $this->getFactory()->create('h1', 'My first header');

        self::assertSame('<h1 class="uppercase">My first header</h1>', $h1->render());
    }

    /**
     * @test
     */
    public function it_creates_custom_html_element(): void
    {
        $element = $this->getFactory()->create('custom-element', 'A custom HTML element');

        self::assertSame('<custom-element>A custom HTML element</custom-element>', $element->render());
    }

    private function getFactory(): HtmlElementFactoryInterface
    {
        $elementCollection = new ElementCollection([
            'abstract-button' => [
                'attributes' => [
                    'class' => 'uppercase font-bold',
                ],
            ],
            'button.primary' => [
                'inherits' => 'abstract-button',
                'tag' => 'button',
                'attributes' => [
                    'class' => 'text-blue',
                    'id' => 'submit',
                ],
            ],
            'h1' => [
                'attributes' => [
                    'class' => 'uppercase',
                ],
            ],
        ]);

        return new HtmlElementFactory($elementCollection);
    }
}
