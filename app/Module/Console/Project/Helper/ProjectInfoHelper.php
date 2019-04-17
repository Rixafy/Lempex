<?php

declare(strict_types=1);

namespace Lempex\Module\Command\Project\Helper;

use Lempex\Model\Project\Exception\ProjectNotFoundException;
use Lempex\Model\Project\ProjectFacade;
use Lempex\Module\Command\CommandHelper;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProjectInfoHelper implements CommandHelper
{
	/** @var ProjectFacade @inject */
	private $projectFacade;

	public function execute(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): void
	{
		$projectName = $input->getArgument('name');

		try {
			$project = $this->projectFacade->getByName($projectName);

			var_dump($project->getData());

		} catch (ProjectNotFoundException $e) {
			$output->writeln($e->getMessage());
		}
	}
}
