<?php

declare(strict_types=1);

namespace SandFox\MonsterID;

const MONSTER_DEFAULT_SIZE = 120; // same as image parts size

/**
 * @param string|null $seed Any string id like email or openid
 * @param int $size Image size (square size x size)
 * @return string PNG image content
 */
function build_monster(?string $seed = null, int $size = MONSTER_DEFAULT_SIZE): string
{
    $monster = new Monster($seed, $size);

    return $monster->getImage();
}

/**
 * @param resource $stream Stream resource, PNG will be written there
 * @param string|null $seed Any string id like email or openid
 * @param int $size Image size (square size x size)
 */
function stream_monster($stream, ?string $seed = null, int $size = MONSTER_DEFAULT_SIZE): void
{
    $monster = new Monster($seed, $size);

    $monster->writeToStream($stream);
}

/**
 * @param string|null $seed Any string id like email or openid
 * @param int $size Image size (square size x size)
 * @return \GdImage|resource GD object
 */
function build_monster_gd(?string $seed = null, int $size = MONSTER_DEFAULT_SIZE)
{
    $monster = new Monster($seed, $size);

    return $monster->getGdImage();
}
