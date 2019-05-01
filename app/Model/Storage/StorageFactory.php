<?php

declare(strict_types=1);

namespace Lempex\Model\Storage;

use Nette\Security\Passwords;
use Ramsey\Uuid\Uuid;

class StorageFactory
{
	/** @var Passwords */
	protected $passwords;

	public function __construct(Passwords $passwords)
	{
		$this->passwords = $passwords;
	}

	public function create(StorageData $storageData): Storage
	{
		$storage = new Storage(Uuid::uuid4(), $storageData);

		if ($storageData->password !== null) {
			$storage->changePassword($storageData->password, $this->passwords);
		}

		return $storage;
	}
}
