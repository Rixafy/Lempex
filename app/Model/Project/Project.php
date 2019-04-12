<?php

declare(strict_types=1);

namespace Lempex\Model\Project;

use Rixafy\DoctrineTraits\DateTimeTrait;

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
	 * @ORM\Column(type="text", length=1023)
	 * @var string
	 */
	private $description;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $user_uid;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $user_gid;

	use DateTimeTrait;

	public function __construct(ProjectData $projectData)
	{
		$this->edit($projectData);
	}

	public function edit(ProjectData $projectData): void
	{
		$this->name = $projectData->name;
		$this->description = $projectData->description;
		$this->user_uid = $projectData->userUid;
		$this->user_gid = $projectData->userGid;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function getUserUid(): int
	{
		return $this->user_uid;
	}

	public function getUserGid(): int
	{
		return $this->user_gid;
	}
}