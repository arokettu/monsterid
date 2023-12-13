<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Randomizer;

use Random\Engine;

final class DefaultV0Factory implements FactoryInterface
{
    public function getRandomizer(string $seed): Engine
    {
        [/*$_*/, $byte1, $byte2, $byte3] = unpack("C3", md5($seed, true));
        $intSeed = $byte1 << 16 | $byte2 << 8 | $byte3;

        // As the original implementation generated on PHP 7.2+
        // https://github.com/splitbrain/monsterID
        return new Engine\Mt19937($intSeed, \MT_RAND_MT19937);
    }
}
