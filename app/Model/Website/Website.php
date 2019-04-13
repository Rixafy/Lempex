<?php

declare(strict_types=1);

namespace Lempex\Model\Website;

use Lempex\Model\Project\Project;
use Rixafy\DoctrineTraits\DateTimeTrait;
use Rixafy\DoctrineTraits\RemovableTrait;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="website")
 */
class Website
{
	/**
	 * @ORM\Column(type="string", length=127, unique=true)
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=255)
	 * @var string
	 */
	private $description;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $domain_level;

	/**
	 * @ORM\ManyToOne(targetEntity="\Lempex\Model\Website\Website", inversedBy="website", cascade={"persist"})
	 * @var Website
	 */
	private $parent;

	/**
	 * @ORM\ManyToOne(targetEntity="\Lempex\Model\Project\Project", inversedBy="website", cascade={"persist"})
	 * @var Project
	 */
	private $project;

	use RemovableTrait;
	use DateTimeTrait;

	public function __construct(WebsiteData $websiteData)
	{
		$this->parent = $websiteData->parent;
		$this->project = $websiteData->project;
		$this->edit($websiteData);
	}

	public function edit(WebsiteData $websiteData): void
	{
		$this->name = $websiteData->name;
		$this->description = $websiteData->description;
		$this->domain_level = $websiteData->domainLevel;
	}

	public function getData(): WebsiteData
	{
		$data = new WebsiteData();

		$data->name = $this->name;
		$data->description = $this->description;
		$data->domainLevel = $this->domain_level;

		return $data;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function getDomainLevel(): int
	{
		return $this->domain_level;
	}

	public function getParent(): Website
	{
		return $this->parent;
	}

	public function getProject(): Project
	{
		return $this->project;
	}
}