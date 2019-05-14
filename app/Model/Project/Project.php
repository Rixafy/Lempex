<?php

declare(strict_types=1);

namespace Lempex\Model\Project;

use Ramsey\Uuid\UuidInterface;
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
	protected $linuxUid;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	protected $linuxGid;

	use RemovableTrait;
	use DateTimeTrait;

	public function __construct(UuidInterface $id, ProjectData $projectData)
	{
		$this->id = $id;
		$this->edit($projectData);
	}

	public function edit(ProjectData $projectData): void
	{
		$this->name = $projectData->name;
		$this->description = $projectData->description;
		$this->linuxUid = $projectData->linuxUid;
		$this->linuxGid = $projectData->linuxGid;
	}

	public function getId(): UuidInterface
	{
		return $this->id;
	}

	public function getData(): ProjectData
	{
		$data = new ProjectData();

		$data->name = $this->name;
		$data->description = $this->description;
		$data->linuxUid = $this->linuxUid;
		$data->linuxGid = $this->linuxGid;

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

	public function getLinuxUid(): int
	{
		return $this->linuxUid;
	}

	public function getLinuxGid(): int
	{
		return $this->linuxGid;
	}
}
