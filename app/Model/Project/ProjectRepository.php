<?php

declare(strict_types=1);

namespace Lempex\Model\Project;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Lempex\Model\Project\Exception\ProjectNotFoundException;
use Ramsey\Uuid\UuidInterface;

class ProjectRepository
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
		return $this->entityManager->getRepository(Project::class);
	}

	/**
	 * @throws ProjectNotFoundException
	 */
	public function get(UuidInterface $id): Project
	{
		/** @var Project $project */
		$project = $this->getRepository()->find($id);

		if ($project === null) {
			throw ProjectNotFoundException::byId($id);
		}

		return $project;
	}

	/**
	 * @throws ProjectNotFoundException
	 */
	public function getByName(string $name): Project
	{
		/** @var Project $project */
		$project = $this->getRepository()->findOneBy([
			'name' => $name
		]);

		if ($project === null) {
			throw ProjectNotFoundException::byName($name);
		}

		return $project;
	}

	/**
	 * @return Project[]
	 */
	public function getAll(): array
	{
		return $this->getRepository()->findAll();
	}
}
