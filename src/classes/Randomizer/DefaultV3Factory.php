<?php

declare(strict_types=1);

namespace SandFox\MonsterID\Randomizer;

use Random\Engine;

class DefaultV3Factory implements FactoryInterface
{
    public function getRandomizer(string $seed): Engine
    {
        // fast and native
        return new Engine\PcgOneseq128XslRr64(md5($seed, true));
    }
}
