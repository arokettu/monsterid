<?php

declare(strict_types=1);

namespace Arokettu\MonsterID;

use Arokettu\MonsterID\Randomizer\DefaultV3Factory;
use Arokettu\MonsterID\Randomizer\FactoryInterface;

final class Config
{
    private static ?FactoryInterface $randomizerFactory = null;

    private static function buildDefault(): FactoryInterface
    {
        return new DefaultV3Factory();
    }

    public static function setRandomizerFactory(FactoryInterface $factory = null): void
    {
        self::$randomizerFactory = $factory ?? self::buildDefault();
    }

    public static function getRandomizerFactory(): FactoryInterface
    {
        return self::$randomizerFactory ??= self::buildDefault();
    }
}
