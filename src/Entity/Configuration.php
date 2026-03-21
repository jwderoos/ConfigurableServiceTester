<?php

declare(strict_types=1);

namespace App\Entity;

use jwderoos\Configurable\Interface\ConfigurableServiceConfigurationInterface;
use jwderoos\Configurable\Trait\ConfigurationPropertiesTrait;

class Configuration implements ConfigurableServiceConfigurationInterface
{
    /** @use ConfigurationPropertiesTrait<ConfigurationProperty> */
    use ConfigurationPropertiesTrait;

    public function getId(): ?int
    {
        return 0;
    }

    public function getPropertyClass(): string
    {
        return ConfigurationProperty::class;
    }
}
