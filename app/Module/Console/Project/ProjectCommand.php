<?php

declare(strict_types=1);

namespace Lempex\Module\Command\Project;

use Lempex\Module\Command\Project\Helper\ProjectAddHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProjectCommand extends Command
{
	/** @var ProjectAddHelper @inject */
	public $projectAddHelper;

	public function configure(): void
	{
		$this->setName('project');
		$this->setDescription('Manipulate with project');
		$this->addArgument('name', InputArgument::REQUIRED, 'Specify project name.')
			->addArgument('cmd', InputArgument::OPTIONAL, 'Specify section (web/ftp/db)');
	}

	public function execute(InputInterface $input, OutputInterface $output): void
	{
		$projectName = $input->getArgument('name');
		$command = $input->getArgument('cmd');

		if ($projectName === 'add' && $command !== 'add') {
			$command = 'add';
		}

		switch ($command) {
			case 'add':
				$this->projectAddHelper->execute($input, $output, $this->getHelper('question'));
		}

		$output->writeln('Hello World ' . $input->getArgument('name'));
	}
}