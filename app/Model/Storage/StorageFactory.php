<?php

declare(strict_types=1);

namespace Lempex\Model\Storage;

class StorageFactory
{
	public function create(StorageData $storageData): Storage
	{
		return new Storage($storageData);
	}
}