<?php

declare(strict_types=1);

namespace Lempex\Module\Command\Project\Helper;

use Lempex\Model\Project\ProjectFactory;
use Lempex\Module\Command\CommandHelper;
use Nette\Utils\Random;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class ProjectAddHelper implements CommandHelper
{
	/** @var ProjectFactory @inject */
	public $projectFactory;

	public function execute(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): void
	{
		$suggestName = $input->getArgument('name');
		$command = $input->getArgument('cmd');

		if ($suggestName === 'add' && $command === null) {
			$projectName = $questionHelper->ask($input, $output, new Question('Please specify project name: '));
		} else {
			$projectName = $questionHelper->ask($input, $output, new Question('Please specify project name [<info>' . $suggestName . '</info>]: ', $suggestName));
		}

		$projectDescription = $questionHelper->ask($input, $output, new Question('Please specify project description: '));

		$addWebsite = $questionHelper->ask($input, $output, new ConfirmationQuestion('Add project website now? [<info>Y/n</info>] ', true));
		if ($addWebsite) {
			$websiteName = $questionHelper->ask($input, $output, new Question('Please specify domain name [<info>' . $webName = ($projectName . '.com') . '</info>] ', $webName));
			$phpVersion = $questionHelper->ask($input, $output, new Question('Please specify default PHP version [<info>' . $phpV = 7.3 . '</info>] ', $phpV));
			$createWwwRedirect = $questionHelper->ask($input, $output, new ConfirmationQuestion('Add redirect from <info>non-www</info> to <info>www</info>? [<info>Y/n</info>] '));
			if (!$createWwwRedirect) {
				$createNonWwwRedirect = $questionHelper->ask($input, $output, new ConfirmationQuestion('Add redirect from <info>www</info> to <info>non-www</info>? [<info>Y/n</info>] '));
			}
		}

		$addStorage = $questionHelper->ask($input, $output, new ConfirmationQuestion('Add FTP storage? [<info>Y/n</info>] ', true));
		if ($addStorage) {
			$storageName = $questionHelper->ask($input, $output, new Question('Please specify FTP name [<info>' . $projectName .'</info>]: ', $projectName));
			$storagePassword = $questionHelper->ask($input, $output, new Question('Create FTP password (or press [Enter] to use this) [<info>' . $ftpPass = Random::generate(16) .'</info>]: ', $ftpPass));
		}
	}
}