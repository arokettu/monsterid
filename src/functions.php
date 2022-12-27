<?php

declare(strict_types=1);

namespace SandFox\MonsterID;

use GdImage;
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
    $monster = new Monster($string, $size, $rngFactory);
    return $monster->getImage();
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
    $monster = new Monster($string, $size, $rngFactory);
    return $monster->writeToStream($stream);
}

/**
 * @param string|null $string Any string id like email or openid
 * @param int $size Image size (square size x size)
 * @return GdImage GD object
 */
function build_monster_gd(
    ?string $string = null,
    int $size = MONSTER_DEFAULT_SIZE,
    ?FactoryInterface $rngFactory = null
): GdImage {
    $monster = new Monster($string, $size, $rngFactory);
    return $monster->getGdImage();
}
