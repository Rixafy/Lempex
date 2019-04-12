<?php

declare(strict_types=1);

namespace Lempex\Model\Website;

use Lempex\Model\Project\Project;
use Rixafy\DoctrineTraits\DateTimeTrait;

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
	private $domain_name;

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

	use DateTimeTrait;

	public function __construct(WebsiteData $websiteData)
	{
		$this->parent = $websiteData->parent;
		$this->project = $websiteData->project;
		$this->edit($websiteData);
	}

	public function edit(WebsiteData $websiteData): void
	{
		$this->domain_name = $websiteData->domainName;
		$this->domain_level = $websiteData->domainLevel;
	}

	public function getData(): WebsiteData
	{
		$data = new WebsiteData();

		$data->domainName = $this->domain_name;
		$data->domainLevel = $this->domain_level;

		return $data;
	}

	public function getDomainName(): string
	{
		return $this->domain_name;
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