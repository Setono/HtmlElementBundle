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
                        'name' => 'h1',
                        'attributes' => [
                            'class' => 'btn btn-primary',
                            'id' => 'btn-submit',
                        ],
                    ],
                ],
            ],
        ], [
            'elements' => [
                'h1' => [
                    'attributes' => [
                        'class' => 'btn btn-primary',
                        'id' => 'btn-submit',
                    ],
                ],
            ],
        ]);
    }
}
