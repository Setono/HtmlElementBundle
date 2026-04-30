<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\Tests\Twig;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Setono\HtmlElementBundle\Config\ElementCollection;
use Setono\HtmlElementBundle\Factory\HtmlElementFactory;
use Setono\HtmlElementBundle\Twig\Extension;
use Setono\HtmlElementBundle\Twig\Runtime;
use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

final class ExtensionTest extends TestCase
{
    /**
     * @param array<string, mixed> $data
     */
    #[DataProvider('getFixtures')]
    public function testIntegration(string $template, array $data, string $expected): void
    {
        $env = new Environment(new ArrayLoader(['index' => $template]), [
            'cache' => false,
            'strict_variables' => true,
        ]);
        $env->addExtension(new Extension());
        $env->addRuntimeLoader(new class() implements RuntimeLoaderInterface {
            public function load(string $class): ?Runtime
            {
                if (Runtime::class !== $class) {
                    return null;
                }

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

                return new Runtime(new HtmlElementFactory($elementCollection));
            }
        });

        self::assertSame($expected, $env->render('index', $data));
    }

    /**
     * @return iterable<string, array{0: string, 1: array<string, mixed>, 2: string}>
     */
    public static function getFixtures(): iterable
    {
        $fixturesDir = realpath(__DIR__ . '/Fixtures');
        \assert(false !== $fixturesDir);

        /** @var \SplFileInfo $file */
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($fixturesDir), \RecursiveIteratorIterator::LEAVES_ONLY) as $file) {
            $path = $file->getRealPath();
            \assert(false !== $path);
            if (1 !== preg_match('/\.test$/', $path)) {
                continue;
            }

            $contents = file_get_contents($path);
            \assert(false !== $contents);
            if (1 !== preg_match('/--TEST--\s*(.*?)\s*--TEMPLATE--\s*(.*?)\s*--DATA--\s*(.*?)\s*--EXPECT--\s*(.*)/s', $contents, $match)) {
                throw new \RuntimeException(sprintf('Test "%s" is not valid.', $path));
            }

            /** @var array<string, mixed> $data */
            $data = eval($match[3] . ';');

            yield str_replace($fixturesDir . '/', '', $path) => [$match[2], $data, rtrim($match[4], "\n")];
        }
    }
}
