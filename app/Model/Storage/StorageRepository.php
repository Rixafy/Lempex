<?php

declare(strict_types=1);

namespace Lempex\Model\Storage;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Lempex\Model\Storage\Exception\StorageNotFoundException;
use Ramsey\Uuid\UuidInterface;

class StorageRepository
{
	/** @var EntityManagerInterface */
	protected $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @return EntityRepository|ObjectRepository
	 */
	private function getRepository()
	{
		return $this->entityManager->getRepository(Storage::class);
	}

	/**
	 * @throws StorageNotFoundException
	 */
	public function get(UuidInterface $id): Storage
	{
		/** @var Storage $storage */
		$storage = $this->getRepository()->find($id);

		if ($storage === null) {
			throw StorageNotFoundException::byId($id);
		}

		return $storage;
	}

	/**
	 * @return Storage[]
	 */
	public function getAllByProject(UuidInterface $projectId): array
	{
		return $this->getRepository()->findBy([
			'project' => $projectId
		]);
	}

	/**
	 * @return Storage[]
	 */
	public function getAll(): array
	{
		return $this->getRepository()->findAll();
	}
}
