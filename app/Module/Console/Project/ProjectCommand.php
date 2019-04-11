<?php

declare(strict_types=1);

namespace Lempex\Module\Command\Project;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProjectCommand extends Command
{
	public function configure(): void
	{
		$this->setName('project');
		$this->setDescription('Manipulate with project');
	}

	public function execute(InputInterface $input, OutputInterface $output): void
	{
		$output->writeln('Hello World');
	}
}