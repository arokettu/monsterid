<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Randomizer;

use Random\Engine;

final class DefaultV0Factory implements FactoryInterface
{
    public function getRandomizer(string $seed): Engine
    {
        // original code was:
        // $intSeed = hexdec(substr(md5($seed),0,6));

        ['val' => $val] = unpack("Nval", md5($seed, true));
        $intSeed = ($val >> 8) & 0xffffff;

        // As the original implementation generated on PHP 7.2+
        // https://github.com/splitbrain/monsterID
        return new Engine\Mt19937($intSeed, \MT_RAND_MT19937);
    }
}
