<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Tests\Twig;

use Setono\HtmlElementBundle\Config\ElementCollection;
use Setono\HtmlElementBundle\Factory\HtmlElementFactory;
use Setono\HtmlElementBundle\Twig\Extension;
use Setono\HtmlElementBundle\Twig\Runtime;
use Twig\RuntimeLoader\RuntimeLoaderInterface;
use Twig\Test\IntegrationTestCase;

class ExtensionTest extends IntegrationTestCase
{
    public function getRuntimeLoaders(): array
    {
        $runtimeLoader = new class() implements RuntimeLoaderInterface {
            public function load(string $class): Runtime
            {
                $elementCollection = ElementCollection::fromArray([
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

                $htmlElementFactory = new HtmlElementFactory($elementCollection);

                return new Runtime($htmlElementFactory);
            }
        };

        return [$runtimeLoader];
    }

    public function getExtensions(): array
    {
        return [
            new Extension(),
        ];
    }

    public function getFixturesDir(): string
    {
        return __DIR__ . '/Fixtures/';
    }
}
