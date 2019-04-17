<?php

declare(strict_types=1);

namespace Lempex\Module\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LempexCommand extends Command
{
	public function configure(): void
	{
		$this->setName('lempex');
		$this->setDescription('Show help');
	}

	public function execute(InputInterface $input, OutputInterface $output): void
	{
		$output->writeln('Hello World');
	}
}
