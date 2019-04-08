<?php

namespace SandFox\MonsterID;

/**
 * @param  string $seed any string id like email or openid
 * @param  int    $size Image size (square size x size)
 * @return string       PNG image content (dump it to page or save to file)
 * @throws PartNotLoadedException
 * @throws ImageNotCreatedException
 */
function build_monster($seed = null, $size = null)
{
    $monster = new Monster($seed);

    return $monster->build($size);
}
