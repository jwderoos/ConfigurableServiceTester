<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use App\Entity\Configuration;
use App\Service\ConfigurableService;
use jwderoos\Configurable\Registry\ConfigurableServiceRegistry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class ConfigurableServiceIntegrationTest extends KernelTestCase
{
    public function testRegistryResolvesConfigurableService(): void
    {
        self::bootKernel();

        $registry = self::getContainer()->get(ConfigurableServiceRegistry::class);
        $this->assertInstanceOf(ConfigurableServiceRegistry::class, $registry);
        $configuration = new Configuration();

        $services = $registry->getConfigurableServicesByConfiguration($configuration);

        $this->assertArrayHasKey(ConfigurableService::class, $services);
        $this->assertInstanceOf(ConfigurableService::class, $services[ConfigurableService::class]);
    }

    public function testPrepareConfigurationCreatesExpectedProperties(): void
    {
        self::bootKernel();

        $registry = self::getContainer()->get(ConfigurableServiceRegistry::class);
        $this->assertInstanceOf(ConfigurableServiceRegistry::class, $registry);
        $configuration = new Configuration();

        foreach ($registry->getConfigurableServicesByConfiguration($configuration) as $configurableService) {
            $configuration->prepareConfiguration($configurableService);
        }

        $this->assertTrue($configuration->propertyExists(ConfigurableService::CONFIG_STRING_OPTION_1));
        $this->assertTrue($configuration->propertyExists(ConfigurableService::CONFIG_OPTIONAL_OPTION_2));
    }
}
