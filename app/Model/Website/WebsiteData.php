<?php

declare(strict_types=1);

namespace Lempex\Model\Website;

use Lempex\Model\Project\Project;

class WebsiteData
{
	/** @var string */
	public $name;

	/** @var string */
	public $description;

	/** @var int */
	public $domainLevel = 2;

	/** @var Website */
	public $parent;

	/** @var Project */
	public $project;
}