<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Tests;

use Arokettu\MonsterID\Randomizer\DefaultV2Factory;
use Arokettu\MonsterID\Randomizer\FactoryInterface;

final class MonsterGenerationV2Test extends MonsterGenerationTestTemplate
{
    protected function getDir(): string
    {
        return 'v2';
    }

    protected function getFactory(): FactoryInterface
    {
        return new DefaultV2Factory();
    }
}
