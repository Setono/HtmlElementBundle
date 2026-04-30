<?php

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return (new Configuration())
    ->addPathToExclude(__DIR__ . '/tests')
    // Required at runtime so the consuming Symfony application boots TwigBundle
    // (this bundle registers a Twig extension via services.xml), but no class
    // in src/ imports it directly — composer-dependency-analyser only sees PHP
    // imports and reports it as unused.
    ->ignoreErrorsOnPackage('symfony/twig-bundle', [ErrorType::UNUSED_DEPENDENCY])
;
