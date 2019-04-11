<?php

declare(strict_types=1);

namespace Lempex;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Types\Type;
use Nette\Configurator;
use Ramsey\Uuid\Doctrine\UuidBinaryType;

class Booting
{
	/**
	 * @throws DBALException
	 */
	public static function boot(): Configurator
	{
		self::additionalSetup();

		$configurator = new Configurator;

		$configurator->setDebugMode(true);
		$configurator->enableTracy(__DIR__ . '/../log');

		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory(__DIR__ . '/../temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$configurator->addConfig(__DIR__ . '/Config/common.neon');

		return $configurator;
	}

	/**
	 * @throws DBALException
	 */
	private static function additionalSetup(): void
	{
		Type::addType(UuidBinaryType::NAME, 'Ramsey\Uuid\Doctrine\UuidBinaryType');
	}
}
