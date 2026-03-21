<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Configuration;
use jwderoos\Configurable\Registry\ConfigurableServiceRegistry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:test', description: 'Runs what ever you need')]
class TestCommand
{
    public function __construct(
        private readonly ConfigurableServiceRegistry $configurableServiceRegistry
    ) {
    }

    public function __invoke(SymfonyStyle $symfonyStyle): int
    {
        $configuration = new Configuration();
        $services = $this->configurableServiceRegistry->getConfigurableServicesByConfiguration($configuration);

        foreach ($services as $service) {
            $configuration->prepareConfiguration($service);
        }

        dump($configuration);

        return Command::SUCCESS;
    }
}
