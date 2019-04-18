<?php

declare(strict_types=1);

namespace Lempex\Model\Project\Exception;

use Exception;
use Ramsey\Uuid\UuidInterface;

class ProjectNotFoundException extends Exception
{
	public static function byId(UuidInterface $id): self
	{
		return new self('Project with id "' . $id . '" not found.');
	}

	public static function byName(string $name): self
	{
		return new self('Project with name "' . $name . '" not found.');
	}
}
