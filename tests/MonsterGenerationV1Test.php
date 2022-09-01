<?php

declare(strict_types=1);

namespace SandFox\MonsterID\Tests;

use SandFox\MonsterID\Randomizer\DefaultV1Factory;
use SandFox\MonsterID\Randomizer\FactoryInterface;

class MonsterGenerationV1Test
{
    protected function getDir(): string
    {
        return 'v1';
    }

    protected function getFactory(): FactoryInterface
    {
        return new DefaultV1Factory();
    }
}
