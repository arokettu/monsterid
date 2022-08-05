<?php

declare(strict_types=1);

namespace SandFox\MonsterID;

use SandFox\MonsterID\Randomizer\FactoryInterface;
use SandFox\MonsterID\Randomizer\DefaultV2Factory;

final class MonsterConfig
{
    /** @var FactoryInterface */
    private static $randomizerFactory = null;

    public static function setRandomizerFactory(FactoryInterface $factory = null): void
    {
        self::$randomizerFactory = $factory ?? new DefaultV2Factory();
    }

    public static function getRandomizerFactory(): FactoryInterface
    {
        if (self::$randomizerFactory === null) {
            self::setRandomizerFactory();
        }

        return self::$randomizerFactory;
    }
}
