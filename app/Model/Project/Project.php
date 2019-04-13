<?php

declare(strict_types=1);

namespace Lempex\Model\Project;

use Rixafy\DoctrineTraits\DateTimeTrait;
use Rixafy\DoctrineTraits\RemovableTrait;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="project")
 */
class Project
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
	private $linux_uid;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $linux_gid;

	use RemovableTrait;
	use DateTimeTrait;

	public function __construct(ProjectData $projectData)
	{
		$this->edit($projectData);
	}

	public function edit(ProjectData $projectData): void
	{
		$this->name = $projectData->name;
		$this->description = $projectData->description;
		$this->linux_uid = $projectData->linuxUid;
		$this->linux_gid = $projectData->linuxGid;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function getLinuxUid(): int
	{
		return $this->linux_uid;
	}

	public function getLinuxGid(): int
	{
		return $this->linux_gid;
	}
}