<?php

declare(strict_types=1);

namespace SandFox\MonsterID;

/**
 * @internal
 *
 * We don't need a perfect randomization for 9 values or so, just use the simplest generator
 */
final class Randomizer
{
    /** @var int */
    private $seed;

    public function __construct(int $seed)
    {
        $this->seed = $seed; // due to php limitations use 31 bit; use 1 if seed is 0
    }

    public function rand(int $min, int $max): int
    {
        // normalize seed
        $this->seed = $this->seed & 0x7fffffff ?: 1;
        // do shifts
        $this->seed ^= ($this->seed << 13) & 0x7fffffff;
        $this->seed ^= ($this->seed >> 17);
        $this->seed ^= ($this->seed << 5) & 0x7fffffff;

        // calculate value
        $divider = $max - $min + 1;
        return $this->seed % $divider + $min;
    }
}
