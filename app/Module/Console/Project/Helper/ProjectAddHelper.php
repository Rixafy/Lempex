<?php

declare(strict_types=1);

namespace Lempex\Module\Command\Project\Helper;

use Doctrine\ORM\EntityManagerInterface;
use Lempex\Model\Project\Project;
use Lempex\Model\Project\ProjectData;
use Lempex\Model\Project\ProjectFactory;
use Lempex\Model\Storage\StorageData;
use Lempex\Model\Storage\StorageFactory;
use Lempex\Model\Website\WebsiteData;
use Lempex\Model\Website\WebsiteFactory;
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
	private $projectFactory;

	/** @var WebsiteFactory @inject */
	private $websiteFactory;

	/** @var StorageFactory @inject */
	private $storageFactory;

	/** @var EntityManagerInterface @inject */
	private $entityManager;

	public function execute(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): void
	{
		$projectData = new ProjectData();
		$websiteData = null;
		$storageData = null;

		$suggestName = $input->getArgument('name');
		$command = $input->getArgument('cmd');

		if ($suggestName === 'add' && $command === null) {
			$projectData->name = $questionHelper->ask($input, $output, new Question('Please specify project name: '));
		} else {
			$projectData->name = $questionHelper->ask($input, $output, new Question('Please specify project name [<info>' . $suggestName . '</info>]: ', $suggestName));
		}

		$projectData->description = $questionHelper->ask($input, $output, new Question('Please specify project description: '));

		$addWebsite = $questionHelper->ask($input, $output, new ConfirmationQuestion('Add project website now? [<info>Y/n</info>] ', false));
		if ($addWebsite) {
			$websiteData = new WebsiteData();
			$websiteData->name = $questionHelper->ask($input, $output, new Question('Please specify domain name [<info>' . $webName = ($projectData->name . '.com') . '</info>] ', $webName));
			$websiteData->phpVersion = $questionHelper->ask($input, $output, new Question('Please specify default PHP version [<info>' . $phpV = 7.3 . '</info>] ', $phpV));
			$websiteData->wwwRedirect = $questionHelper->ask($input, $output, new ConfirmationQuestion('Add redirect from <info>non-www</info> to <info>www</info>? [<info>Y/n</info>] '));
			if (!$websiteData->wwwRedirect) {
				$websiteData->nonWwwRedirect = $questionHelper->ask($input, $output, new ConfirmationQuestion('Add redirect from <info>www</info> to <info>non-www</info>? [<info>Y/n</info>] '));
			}
		}

		$addStorage = $questionHelper->ask($input, $output, new ConfirmationQuestion('Add FTP storage now? [<info>Y/n</info>] ', false));
		if ($addStorage) {
			$storageData = new StorageData();
			$storageData->name = $questionHelper->ask($input, $output, new Question('Please specify FTP name [<info>' . $projectData->name .'</info>]: ', $projectData->name));
			$storageData->password = $questionHelper->ask($input, $output, new Question('Create FTP password (or press [Enter] to use this) [<info>' . $ftpPass = Random::generate(16) .'</info>]: ', $ftpPass));
		}

		$project = $this->projectFactory->create($projectData);
		$this->entityManager->persist($project);

		if ($websiteData !== null) {
			$websiteData->project = $project;
			$this->entityManager->persist($this->websiteFactory->create($websiteData));
		}

		if ($storageData !== null) {
			$storageData->project = $project;
			$this->entityManager->persist($this->storageFactory->create($storageData));
		}

		$this->entityManager->flush();
	}
}