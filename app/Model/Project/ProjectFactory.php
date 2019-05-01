<?php

declare(strict_types=1);

namespace Lempex\Model\Project;

use Ramsey\Uuid\Uuid;

class ProjectFactory
{
	public function create(ProjectData $projectData): Project
	{
		return new Project(Uuid::uuid4(), $projectData);
	}
}
