<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Tests;

use Arokettu\MonsterID\Randomizer\DefaultV0Factory;
use Arokettu\MonsterID\Randomizer\FactoryInterface;

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
