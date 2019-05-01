<?php

declare(strict_types=1);

namespace Lempex\Model\Website;

use Doctrine\ORM\EntityManagerInterface;
use Lempex\Model\Website\Exception\WebsiteNotFoundException;
use Ramsey\Uuid\UuidInterface;

class WebsiteRepository
{
	/** @var EntityManagerInterface */
	protected $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	private function getRepository()
	{
		return $this->entityManager->getRepository(Website::class);
	}

	/**
	 * @throws WebsiteNotFoundException
	 */
	public function get(UuidInterface $id): Website
	{
		/** @var Website $website */
		$website = $this->getRepository()->find($id);

		if ($website === null) {
			throw WebsiteNotFoundException::byId($id);
		}

		return $website;
	}

	/**
	 * @return Website[]
	 */
	public function getAllByProject(UuidInterface $projectId): array
	{
		return $this->getRepository()->findBy([
			'project' => $projectId
		]);
	}

	/**
	 * @return Website[]
	 */
	public function getAll(): array
	{
		return $this->getRepository()->findAll();
	}
}
