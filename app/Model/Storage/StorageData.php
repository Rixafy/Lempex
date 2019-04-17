<?php

declare(strict_types=1);

namespace Lempex\Model\Storage;

use Lempex\Model\Project\Project;

class StorageData
{
	/** @var string */
	public $name;

	/** @var string */
	public $password;

	/** @var string */
	public $description;

	/** @var string */
	public $rootDirectory;

	/** @var string */
	public $shell = '/sbin/nologin';

	/** @var Project */
	public $project;
}
