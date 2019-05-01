<?php

declare(strict_types=1);

namespace Lempex\Model\Website;

use Lempex\Model\Project\Project;
use Ramsey\Uuid\UuidInterface;
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
	 * @var UuidInterface
	 * @ORM\Id
	 * @ORM\Column(type="uuid_binary", unique=true)
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=127, unique=true)
	 * @var string
	 */
	protected $name;

	/**
	 * @ORM\Column(type="string", length=255)
	 * @var string
	 */
	protected $description;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	protected $domain_level;

	/**
	 * @ORM\Column(type="float")
	 * @var float
	 */
	protected $php_version;

	/**
	 * @ORM\Column(type="boolean")
	 * @var bool
	 */
	protected $www_redirect;

	/**
	 * @ORM\Column(type="boolean")
	 * @var bool
	 */
	protected $non_www_redirect;

	/**
	 * @ORM\ManyToOne(targetEntity="\Lempex\Model\Website\Website", inversedBy="website", cascade={"persist"})
	 * @var Website
	 */
	protected $parent;

	/**
	 * @ORM\ManyToOne(targetEntity="\Lempex\Model\Project\Project", inversedBy="website", cascade={"persist"})
	 * @var Project
	 */
	protected $project;

	use RemovableTrait;
	use DateTimeTrait;

	public function __construct(UuidInterface $id, WebsiteData $websiteData)
	{
		$this->id = $id;
		$this->parent = $websiteData->parent;
		$this->project = $websiteData->project;
		$this->edit($websiteData);
	}

	public function edit(WebsiteData $websiteData): void
	{
		$this->name = $websiteData->name;
		$this->description = $websiteData->description;
		$this->domain_level = $websiteData->domainLevel;
		$this->php_version = $websiteData->phpVersion;
		$this->www_redirect = $websiteData->wwwRedirect;
		$this->non_www_redirect = $websiteData->nonWwwRedirect;
	}

	public function getId(): UuidInterface
	{
		return $this->id;
	}

	public function getData(): WebsiteData
	{
		$data = new WebsiteData();

		$data->name = $this->name;
		$data->description = $this->description;
		$data->domainLevel = $this->domain_level;
		$data->phpVersion = $this->php_version;
		$data->wwwRedirect = $this->www_redirect;
		$data->nonWwwRedirect = $this->non_www_redirect;

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

	public function getPhpVersion(): float
	{
		return $this->php_version;
	}

	public function isWwwRedirect(): bool
	{
		return $this->www_redirect;
	}

	public function isNonWwwRedirect(): bool
	{
		return $this->non_www_redirect;
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
