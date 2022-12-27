<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Randomizer;

use Random\Engine;

final class DefaultV2Factory implements FactoryInterface
{
    public function getRandomizer(string $seed): Engine
    {
        $binSeed = md5($seed, true);

        // first index of unpack is 1
        // convert to 32bit signed integer
        [/* $_ */, $intSeed] = unpack('l', $binSeed);

        return new Xorshift32($intSeed);
    }
}
