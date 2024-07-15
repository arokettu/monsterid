<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Randomizer;

use Random\Engine;

/**
 * @internal
 *
 * We don't need a perfect randomization for 9 values or so, just use the simplest generator
 */
final class Xorshift32 implements Engine
{
    public function __construct(
        private int $seed,
    ) {
    }

    public function generate(): string
    {
        // normalize seed
        $this->seed = $this->seed & 0x7fffffff ?: 1;
        // do shifts
        $this->seed ^= ($this->seed << 13) & 0x7fffffff;
        $this->seed ^= ($this->seed >> 17);
        $this->seed ^= ($this->seed << 5) & 0x7fffffff;

        return pack('V', $this->seed); // 32 bit value
    }
}
