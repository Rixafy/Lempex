<?php

declare(strict_types=1);

namespace Lempex\Module\Command\Project\Helper;

use Lempex\Model\Project\ProjectFacade;
use Lempex\Module\Command\CommandHelper;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProjectEditHelper implements CommandHelper
{
	/** @var ProjectFacade @inject */
	private $projectFacade;

	public function execute(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): void
	{

	}
}
