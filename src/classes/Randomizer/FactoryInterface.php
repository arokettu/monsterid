<?php

declare(strict_types=1);

namespace SandFox\MonsterID\Randomizer;

use Random\Engine;

interface FactoryInterface
{
    public function getRandomizer(string $seed): Engine;
}
