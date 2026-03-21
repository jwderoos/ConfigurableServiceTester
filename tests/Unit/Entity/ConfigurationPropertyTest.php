<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Configuration;
use App\Entity\ConfigurationProperty;
use jwderoos\Configurable\Interface\ConfigurableServiceConfigurationInterface;
use PHPUnit\Framework\TestCase;

final class ConfigurationPropertyTest extends TestCase
{
    public function testSetConfigurationAndGetConfiguration(): void
    {
        $configurationProperty = new ConfigurationProperty();
        $configuration = new Configuration();

        $configurationProperty->setConfiguration($configuration);

        $this->assertSame($configuration, $configurationProperty->getConfiguration());
    }

    public function testSetOwnerWithConfigurationSetsOwner(): void
    {
        $configurationProperty = new ConfigurationProperty();
        $configuration = new Configuration();

        $configurationProperty->setOwner($configuration);

        $this->assertSame($configuration, $configurationProperty->getOwner());
    }

    public function testSetOwnerWithNonConfigurationDoesNotSetOwner(): void
    {
        $configurationProperty = new ConfigurationProperty();
        $configuration = new Configuration();
        $configurationProperty->setOwner($configuration);

        $otherConfiguration = $this->createStub(ConfigurableServiceConfigurationInterface::class);
        $configurationProperty->setOwner($otherConfiguration);

        $this->assertSame($configuration, $configurationProperty->getOwner());
    }
}
