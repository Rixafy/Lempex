<?php

declare(strict_types=1);

namespace Lempex\Model\Website;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class WebsiteFacade
{
	/** @var EntityManagerInterface */
	private $entityManager;

	/** @var WebsiteRepository */
	private $websiteRepository;

	/** @var WebsiteFactory */
	private $websiteFactory;

	public function __construct(
		EntityManagerInterface $entityManager,
		WebsiteRepository $websiteRepository,
		WebsiteFactory $websiteFactory
	) {
		$this->entityManager = $entityManager;
		$this->websiteRepository = $websiteRepository;
		$this->websiteFactory = $websiteFactory;
	}

	public function create(WebsiteData $websiteData): Website
	{
		$website = $this->websiteFactory->create($websiteData);

		$this->entityManager->persist($website);
		$this->entityManager->flush();

		return $website;
	}

	/**
	 * @throws Exception\WebsiteNotFoundException
	 */
	public function get(UuidInterface $id): Website
	{
		return $this->websiteRepository->get($id);
	}

	/**
	 * @return Website[]
	 */
	public function getAllByProject(UuidInterface $projectId): array
	{
		return $this->websiteRepository->getAllByProject($projectId);
	}

	/**
	 * @throws Exception\WebsiteNotFoundException
	 */
	public function edit(UuidInterface $id, WebsiteData $websiteData, bool $flush = true): Website
	{
		$website = $this->get($id);

		$website->edit($websiteData);

		if ($flush) {
			$this->entityManager->flush();
		}

		return $website;
	}

	/**
	 * @throws Exception\WebsiteNotFoundException
	 */
	public function remove(UuidInterface $id): bool
	{
		$website = $this->get($id);

		$website->remove();
		$this->entityManager->flush();

		return $website->isRemoved();
	}
}