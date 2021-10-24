<?php

use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SetList::SYMFONY);
    $containerConfigurator->import(SetList::STRICT);

    $services = $containerConfigurator->services();
    $services->set(ReturnAssignmentFixer::class);
    $services->set(LineLengthFixer::class);

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, ['src']);
};
