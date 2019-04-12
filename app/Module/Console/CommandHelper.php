<?php

declare(strict_types=1);

namespace Lempex\Module\Command;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface CommandHelper
{
	public function execute(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): void;
}