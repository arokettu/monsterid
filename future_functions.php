<?php

declare(strict_types=1);

namespace Arokettu\MonsterID;

use SandFox\MonsterID\Randomizer\FactoryInterface;

const MONSTER_DEFAULT_SIZE = 120; // same as image parts size

/**
 * @param string|null $string Any string id like email or openid
 * @param int $size Image size (square size x size)
 * @return string PNG image content
 */
function build_monster(
    ?string $string = null,
    int $size = MONSTER_DEFAULT_SIZE,
    ?FactoryInterface $rngFactory = null
): string {
    return \SandFox\MonsterID\build_monster($string, $size, $rngFactory);
}

/**
 * @param resource $stream Stream resource, PNG will be written there
 * @param string|null $string Any string id like email or openid
 * @param int $size Image size (square size x size)
 * @return resource The same stream as $stream
 */
function stream_monster(
    $stream,
    ?string $string = null,
    int $size = MONSTER_DEFAULT_SIZE,
    ?FactoryInterface $rngFactory = null
) {
    return \SandFox\MonsterID\stream_monster($stream, $string, $size, $rngFactory);
}

/**
 * @param string|null $string Any string id like email or openid
 * @param int $size Image size (square size x size)
 * @return \GdImage|resource GD object
 */
function build_monster_gd(
    ?string $string = null,
    int $size = MONSTER_DEFAULT_SIZE,
    ?FactoryInterface $rngFactory = null
) {
    return \SandFox\MonsterID\build_monster_gd($string, $size, $rngFactory);
}
