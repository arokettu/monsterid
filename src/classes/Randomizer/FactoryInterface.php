<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Randomizer;

use Random\Engine;

interface FactoryInterface
{
    public function getRandomizer(string $seed): Engine;
}
