<?php

declare(strict_types=1);

namespace SandFox\MonsterID;

/**
 * @internal
 */
final class Randomizer
{
    /** @var int */
    private $seed;

    public function __construct(int $seed)
    {
        $this->seed = $seed;
    }

    public function rand(int $min, int $max): int
    {
        $divider = $max - $min + 1;

        $value = $this->seed % $divider + $min;
        $this->seed = intdiv($this->seed, $divider);
        return $value;
    }
}
