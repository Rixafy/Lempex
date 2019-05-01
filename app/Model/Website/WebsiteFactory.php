<?php

declare(strict_types=1);

namespace Lempex\Model\Website;

use Ramsey\Uuid\Uuid;

class WebsiteFactory
{
	public function create(WebsiteData $websiteData): Website
	{
		return new Website(Uuid::uuid4(), $websiteData);
	}
}
