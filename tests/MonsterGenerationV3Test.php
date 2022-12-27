<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Tests;

use Arokettu\MonsterID\Randomizer\DefaultV3Factory;
use Arokettu\MonsterID\Randomizer\FactoryInterface;

class MonsterGenerationV3Test extends MonsterGenerationTestTemplate
{
    protected function getDir(): string
    {
        return 'v3';
    }

    protected function getFactory(): FactoryInterface
    {
        return new DefaultV3Factory();
    }
}
