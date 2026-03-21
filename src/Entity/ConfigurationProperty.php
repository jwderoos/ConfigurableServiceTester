<?php

declare(strict_types=1);

namespace App\Entity;

use jwderoos\Configurable\Interface\ConfigurableServiceConfigurationInterface;
use jwderoos\Configurable\Interface\ConfigurableServiceConfigurationPropertyInterface;
use jwderoos\Configurable\Trait\ConfigurationPropertyTrait;

class ConfigurationProperty implements ConfigurableServiceConfigurationPropertyInterface
{
    use ConfigurationPropertyTrait;

    private Configuration $configuration;

    public function setConfiguration(Configuration $configuration): void
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    public function setOwner(ConfigurableServiceConfigurationInterface $configurableServiceConfiguration): void
    {
        if ($configurableServiceConfiguration instanceof Configuration) {
            $this->configuration = $configurableServiceConfiguration;
        }
    }

    public function getOwner(): ConfigurableServiceConfigurationInterface
    {
        return $this->getConfiguration();
    }
}
