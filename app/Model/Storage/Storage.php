<?php

declare(strict_types=1);

namespace Lempex\Model\Storage;

use DateTime;
use Lempex\Model\Project\Project;
use Nette\Security\Passwords;
use Ramsey\Uuid\UuidInterface;
use Rixafy\DoctrineTraits\DateTimeTrait;
use Rixafy\DoctrineTraits\RemovableTrait;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="storage")
 */
class Storage
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
	 * @ORM\Column(type="string", length=255)
	 * @var string
	 */
	protected $password;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	protected $linux_uid;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	protected $linux_gid;

	/**
	 * @ORM\Column(type="string", length=127)
	 * @var string
	 */
	protected $root_directory;

	/**
	 * @ORM\Column(type="string", length=127)
	 * @var string
	 */
	protected $shell;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	protected $connection_count = 0;

	/**
	 * @ORM\ManyToOne(targetEntity="\Lempex\Model\Project\Project", inversedBy="storage", cascade={"persist"})
	 * @var Project
	 */
	protected $project;

	/**
	 * @ORM\Column(type="datetime")
	 * @var DateTime
	 */
	protected $last_modified_at;

	/**
	 * @ORM\Column(type="datetime")
	 * @var DateTime
	 */
	protected $first_connection_at;

	/**
	 * @ORM\Column(type="datetime")
	 * @var DateTime
	 */
	protected $last_connection_at;

	use RemovableTrait;
	use DateTimeTrait;

	public function __construct(UuidInterface $id, StorageData $storageData)
	{
		$this->id = $id;
		$this->project = $storageData->project;
		$this->linux_uid = $this->project->getLinuxUid();
		$this->linux_gid = $this->project->getLinuxGid();
		$this->edit($storageData);
	}

	public function edit(StorageData $storageData): void
	{
		$this->name = $storageData->name;
		$this->description = $storageData->description;
		$this->root_directory = $storageData->rootDirectory;
		$this->shell = $storageData->shell;
	}

	public function getId(): UuidInterface
	{
		return $this->id;
	}

	public function getData(): StorageData
	{
		$data = new StorageData();

		$data->name = $this->name;
		$data->description = $this->description;
		$data->rootDirectory = $this->root_directory;
		$data->shell = $this->shell;

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

	public function changePassword(string $plainText, Passwords $passwords): void
	{
		$this->password = $passwords->hash($plainText);
	}

	public function checkPassword(string $plainText, Passwords $passwords): bool
	{
		return $passwords->verify($plainText, $this->password);
	}

	public function getLinuxUid(): int
	{
		return $this->linux_uid;
	}

	public function getLinuxGid(): int
	{
		return $this->linux_gid;
	}

	public function getRootDirectory(): string
	{
		return $this->root_directory;
	}

	public function getShell(): string
	{
		return $this->shell;
	}

	public function getConnectionCount(): int
	{
		return $this->connection_count;
	}

	public function getProject(): Project
	{
		return $this->project;
	}

	public function getLastModifiedAt(): DateTime
	{
		return $this->last_modified_at;
	}

	public function getFirstConnectionAt(): DateTime
	{
		return $this->first_connection_at;
	}

	public function getLastConnectionAt(): DateTime
	{
		return $this->last_connection_at;
	}
}
