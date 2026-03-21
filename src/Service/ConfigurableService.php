<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Configuration;
use jwderoos\Configurable\Interface\ConfigurableServiceInterface;
use jwderoos\Configurable\Trait\ConfigurableServiceTrait;

class ConfigurableService implements ConfigurableServiceInterface
{
    use ConfigurableServiceTrait;

    public const CONFIG_STRING_OPTION_1 = 'ConfigurableOption1';

    public const CONFIG_OPTIONAL_OPTION_2 = 'ConfigurableOption2';

    public static function getConfigurationClass(): string
    {
        return Configuration::class;
    }
}
