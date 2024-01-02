<?php

declare(strict_types=1);

namespace Arokettu\MonsterID;

use Arokettu\MonsterID\Randomizer\FactoryInterface;
use GdImage;

const MONSTER_DEFAULT_SIZE = 120; // same as image parts size

/**
 * @param string $string Any string id like email or openid
 * @param int $size Image size (square size x size)
 * @return string PNG image content
 */
function build_monster(
    string $string,
    int $size = MONSTER_DEFAULT_SIZE,
    ?FactoryInterface $rngFactory = null,
): string {
    $monster = new Monster($string, $size, $rngFactory);
    return $monster->getImage();
}

/**
 * @param resource|null $stream Stream resource (or new php://temp), PNG will be written there
 * @param string $string Any string id like email or openid
 * @param int $size Image size (square size x size)
 * @return resource The same stream as $stream
 */
function stream_monster(
    $stream,
    string $string,
    int $size = MONSTER_DEFAULT_SIZE,
    ?FactoryInterface $rngFactory = null,
) {
    $monster = new Monster($string, $size, $rngFactory);
    return $monster->writeToStream($stream);
}

/**
 * @param string $string Any string id like email or openid
 * @param int $size Image size (square size x size)
 * @return GdImage GD object
 */
function build_monster_gd(
    string $string,
    int $size = MONSTER_DEFAULT_SIZE,
    ?FactoryInterface $rngFactory = null,
): GdImage {
    $monster = new Monster($string, $size, $rngFactory);
    return $monster->getGdImage();
}
