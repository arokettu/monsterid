<?php

/**
 * @copyright 2015 Anton Smirnov
 * @license MIT https://spdx.org/licenses/MIT.html
 */

declare(strict_types=1);

namespace Arokettu\MonsterID\Tests;

use Arokettu\MonsterID\Randomizer\DefaultV1Factory;
use Arokettu\MonsterID\Randomizer\FactoryInterface;

final class MonsterGenerationV1Test extends MonsterGenerationTestTemplate
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
