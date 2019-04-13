<?php

declare(strict_types=1);

namespace Lempex\Model\Project;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class ProjectFacade
{
	/** @var EntityManagerInterface */
	private $entityManager;

	/** @var ProjectRepository */
	private $projectRepository;

	/** @var ProjectFactory */
	private $projectFactory;

	public function __construct(
		EntityManagerInterface $entityManager,
		ProjectRepository $projectRepository,
		ProjectFactory $projectFactory
	) {
		$this->entityManager = $entityManager;
		$this->projectRepository = $projectRepository;
		$this->projectFactory = $projectFactory;
	}

	public function create(ProjectData $projectData): Project
	{
		$project = $this->projectFactory->create($projectData);

		$this->entityManager->persist($project);
		$this->entityManager->flush();

		return $project;
	}

	/**
	 * @throws Exception\ProjectNotFoundException
	 */
	public function get(UuidInterface $id): Project
	{
		return $this->projectRepository->get($id);
	}

	/**
	 * @throws Exception\ProjectNotFoundException
	 */
	public function edit(UuidInterface $id, ProjectData $projectData): Project
	{
		$project = $this->get($id);

		$project->edit($projectData);
		$this->entityManager->flush();

		return $project;
	}


	/**
	 * @throws Exception\ProjectNotFoundException
	 */
	public function remove(UuidInterface $id): bool
	{
		$project = $this->get($id);

		$project->remove();
		$this->entityManager->flush();

		return $project->isRemoved();
	}
}