<?php

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return (new Configuration())
    ->addPathToExclude(__DIR__ . '/tests')
    // Wired through Doctrine ORM XML mapping (`<gedmo:timestampable>` on createdAt /
    // updatedAt / scannedAt fields), not via a PHP `use`. The analyser only inspects
    // PHP sources so it cannot see the dependency.
    ->ignoreErrorsOnPackage('gedmo/doctrine-extensions', [ErrorType::UNUSED_DEPENDENCY])
    // Runtime-only collaborator of endroid/qr-code: the PDF writer instantiates FPDF
    // internally when format=pdf is requested. The plugin never references FPDF in PHP,
    // so the analyser doesn't see the link, but the class must be on the classpath in
    // production for the admin PDF download to work (see issue #1).
    ->ignoreErrorsOnPackage('setasign/fpdf', [ErrorType::UNUSED_DEPENDENCY])
;
