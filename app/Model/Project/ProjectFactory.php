<?php

declare(strict_types=1);

namespace Lempex\Model\Project;

class ProjectFactory
{
	public function create(ProjectData $projectData): Project
	{
		return new Project($projectData);
	}
}
