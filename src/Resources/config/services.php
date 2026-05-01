<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Setono\HtmlElementBundle\Config\ElementCollection;
use Setono\HtmlElementBundle\Factory\HtmlElementFactory;
use Setono\HtmlElementBundle\Factory\HtmlElementFactoryInterface;
use Setono\HtmlElementBundle\Twig\Extension;
use Setono\HtmlElementBundle\Twig\Runtime;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set('setono_html_element.config.element_collection', ElementCollection::class)
        ->factory([ElementCollection::class, 'fromArray'])
        ->args(['%setono_html_element.elements%'])
    ;

    $services->set('setono_html_element.factory.html_element', HtmlElementFactory::class)
        ->args([service('setono_html_element.config.element_collection')])
    ;
    $services->alias(HtmlElementFactoryInterface::class, 'setono_html_element.factory.html_element');

    $services->set('setono_html_element.twig.extension', Extension::class)
        ->tag('twig.extension')
    ;

    $services->set('setono_html_element.twig.runtime', Runtime::class)
        ->args([service('setono_html_element.factory.html_element')])
        ->tag('twig.runtime')
    ;
};
