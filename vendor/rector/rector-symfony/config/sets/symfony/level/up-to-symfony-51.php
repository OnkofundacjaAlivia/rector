<?php

declare (strict_types=1);
namespace RectorPrefix20220608;

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\SymfonyLevelSetList;
use Rector\Symfony\Set\SymfonySetList;
return static function (RectorConfig $rectorConfig) : void {
    $rectorConfig->sets([SymfonySetList::SYMFONY_51, SymfonyLevelSetList::UP_TO_SYMFONY_50]);
};
