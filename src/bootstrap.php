<?php

namespace SandFox\MonsterID;

/**
 * @param string|null $seed Any string id like email or openid
 * @param int|null $size Image size (square size x size)
 * @return string PNG image content
 */
function build_monster(?string $seed = null, ?int $size = null): string
{
    $monster = new Monster($seed, $size);

    return $monster->getImage();
}

/**
 * @param resource $stream Stream resource, PNG will be written there
 * @param string|null $seed Any string id like email or openid
 * @param int|null $size Image size (square size x size)
 */
function stream_monster($stream, ?string $seed = null, ?int $size = null): void
{
    $monster = new Monster($seed, $size);

    $monster->writeToStream($stream);
}

/**
 * @param string|null $seed Any string id like email or openid
 * @param int|null $size Image size (square size x size)
 * @return \GdImage|resource GD object
 */
function build_monster_gd(?string $seed = null, ?int $size = null)
{
    $monster = new Monster($seed, $size);

    return $monster->getGdImage();
}
