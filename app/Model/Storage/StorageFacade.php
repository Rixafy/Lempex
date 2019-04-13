<?php

declare(strict_types=1);

namespace Lempex\Model\Storage;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class StorageFacade
{
	/** @var EntityManagerInterface */
	private $entityManager;

	/** @var StorageRepository */
	private $storageRepository;

	/** @var StorageFactory */
	private $storageFactory;

	public function __construct(
		EntityManagerInterface $entityManager,
		StorageRepository $storageRepository,
		StorageFactory $storageFactory
	) {
		$this->entityManager = $entityManager;
		$this->storageRepository = $storageRepository;
		$this->storageFactory = $storageFactory;
	}

	public function create(StorageData $storageData): Storage
	{
		$storage = $this->storageFactory->create($storageData);

		$this->entityManager->persist($storage);
		$this->entityManager->flush();

		return $storage;
	}

	/**
	 * @throws Exception\StorageNotFoundException
	 */
	public function get(UuidInterface $id): Storage
	{
		return $this->storageRepository->get($id);
	}

	/**
	 * @return Storage[]
	 */
	public function getAllByProject(UuidInterface $projectId): array
	{
		return $this->storageRepository->getAllByProject($projectId);
	}

	/**
	 * @throws Exception\StorageNotFoundException
	 */
	public function edit(UuidInterface $id, StorageData $storageData): Storage
	{
		$storage = $this->get($id);

		$storage->edit($storageData);
		$this->entityManager->flush();

		return $storage;
	}

	/**
	 * @throws Exception\StorageNotFoundException
	 */
	public function remove(UuidInterface $id): bool
	{
		$storage = $this->get($id);

		$storage->remove();
		$this->entityManager->flush();

		return $storage->isRemoved();
	}
}