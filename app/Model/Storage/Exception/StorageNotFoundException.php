<?php

declare(strict_types=1);

namespace Lempex\Model\Storage\Exception;

use Exception;
use Ramsey\Uuid\UuidInterface;

class StorageNotFoundException extends Exception
{
	public static function byId(UuidInterface $id): self
	{
		return new self('Storage with id "' . $id . '" not found.');
	}
}
