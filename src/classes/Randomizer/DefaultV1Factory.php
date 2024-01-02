<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Randomizer;

use Random\Engine;

final class DefaultV1Factory implements FactoryInterface
{
    public function getRandomizer(string $seed): Engine
    {
        ['val' => $intSeed] = unpack('lval', md5($seed, true)); // convert to 32bit signed integer

        // As v1.3.0 generated on PHP 7.2+
        return new Engine\Mt19937($intSeed, \MT_RAND_MT19937);
    }
}
