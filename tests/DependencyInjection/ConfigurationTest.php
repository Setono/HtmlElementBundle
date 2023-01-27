<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Tests\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;
use Setono\HtmlElementBundle\DependencyInjection\Configuration;

class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    protected function getConfiguration(): Configuration
    {
        return new Configuration();
    }

    /**
     * @test
     */
    public function processed_value_contains_required_value(): void
    {
        $this->assertProcessedConfigurationEquals([
            [
                'elements' => [
                    [
                        'name' => 'abstract-button',
                        'attributes' => [
                            'class' => 'uppercase font-bold',
                        ],
                    ],
                    [
                        'name' => 'button.primary',
                        'inherits' => 'abstract-button',
                        'tag' => 'button',
                        'attributes' => [
                            'class' => 'text-blue',
                            'id' => 'submit',
                        ],
                    ],
                    [
                        'name' => 'h1',
                        'attributes' => [
                            'class' => 'uppercase',
                        ],
                    ],
                ],
            ],
        ], [
            'elements' => [
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
            ],
        ]);
    }
}
