<?php

namespace SandFoxMe\MonsterID;

/**
 * @deprecated \SandFox\MonsterID\Monster
 */
class Monster extends \SandFox\MonsterID\Monster {}

/**
 * @deprecated \SandFox\MonsterID\build_monster
 */
function build_monster($seed = null, $size = null)
{
    return \SandFox\MonsterID\build_monster($seed, $size);
}

class_alias(
    '\SandFox\MonsterID\ImageNotCreatedException',
    '\SandFoxMe\MonsterID\ImageNotCreatedException'
);
class_alias(
    '\SandFox\MonsterID\MonsterException',
    '\SandFoxMe\MonsterID\MonsterException'
);
class_alias(
    '\SandFox\MonsterID\PartNotLoadedException',
    '\SandFoxMe\MonsterID\PartNotLoadedException'
);
