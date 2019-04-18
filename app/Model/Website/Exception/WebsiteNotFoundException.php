<?php

declare(strict_types=1);

namespace Lempex\Model\Website\Exception;

use Exception;
use Ramsey\Uuid\UuidInterface;

class WebsiteNotFoundException extends Exception
{
	public static function byId(UuidInterface $id): self
	{
		return new self('Website with id "' . $id . '" not found.');
	}
}
