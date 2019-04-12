<?php

declare(strict_types=1);

namespace Lempex\Model\Website;

class WebsiteFactory
{
	public function create(WebsiteData $websiteData): Website
	{
		return new Website($websiteData);
	}
}