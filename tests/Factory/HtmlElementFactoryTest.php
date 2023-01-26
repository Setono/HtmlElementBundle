<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Tests\Factory;

use PHPUnit\Framework\TestCase;
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

        self::assertSame('<h1 id="header" class="uppercase font-bold">My first header</h1>', $h1->render());
    }

    private function getFactory(): HtmlElementFactoryInterface
    {
        return new HtmlElementFactory([
            'h1' => [
                'attributes' => [
                    'id' => 'header',
                    'class' => 'uppercase font-bold',
                ],
            ],
        ]);
    }
}
