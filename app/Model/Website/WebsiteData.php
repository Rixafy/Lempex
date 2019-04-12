<?php

declare(strict_types=1);

namespace Lempex\Model\Project;

use Lempex\Model\Website\Website;

class WebsiteData
{
	/** @var string */
	public $domainName;

	/** @var int */
	public $domainLevel = 2;

	/** @var Website */
	public $parent;

	/** @var Project */
	public $project;
}