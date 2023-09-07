<?php

declare(strict_types=1);

namespace SandFox\MonsterID\Tests;

use SandFox\MonsterID\Randomizer\DefaultV0Factory;
use SandFox\MonsterID\Randomizer\FactoryInterface;

class MonsterGenerationV0Test extends MonsterGenerationTestTemplate
{
    protected function getDir(): string
    {
        return 'v0';
    }

    protected function getFactory(): FactoryInterface
    {
        return new DefaultV0Factory();
    }
}
