<?php

declare(strict_types=1);

namespace Lempex\Model\Project;

use Doctrine\ORM\EntityManagerInterface;
use Lempex\Model\Project\Exception\ProjectNotFoundException;
use Ramsey\Uuid\UuidInterface;

class ProjectRepository
{
	/** @var EntityManagerInterface */
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

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
			throw new ProjectNotFoundException('Project with id ' . $id . ' not found.');
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