<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Randomizer;

use Random\Engine;

final class DefaultV3Factory implements FactoryInterface
{
    public function getRandomizer(string $seed): Engine
    {
        // fast and native
        return new Engine\Xoshiro256StarStar(hash('sha256', $seed, true));
    }
}
