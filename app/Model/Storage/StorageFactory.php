<?php

declare(strict_types=1);

namespace Lempex\Model\Storage;

use Nette\Security\Passwords;

class StorageFactory
{
	/** @var Passwords */
	private $passwords;

	public function __construct(Passwords $passwords)
	{
		$this->passwords = $passwords;
	}

	public function create(StorageData $storageData): Storage
	{
		$storage = new Storage($storageData);

		if ($storageData->password !== null) {
			$storage->changePassword($storageData->password, function(string $password): string {
				return $this->passwords->hash($password);
			});
		}

		return $storage;
	}
}
