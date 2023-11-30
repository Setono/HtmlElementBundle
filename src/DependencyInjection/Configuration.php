<?php

declare(strict_types=1);

namespace Setono\HtmlElementBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('setono_html_element');

        $rootNode = $treeBuilder->getRootNode();

        /** @psalm-suppress MixedMethodCall, PossiblyUndefinedMethod, PossiblyNullReference, UndefinedInterfaceMethod */
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('elements')
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('tag')->cannotBeEmpty()->end()
                            ->scalarNode('inherits')->cannotBeEmpty()->end()
                            ->arrayNode('attributes')
                                ->useAttributeAsKey('name')
                                ->scalarPrototype()->end()
        ;

        return $treeBuilder;
    }
}
