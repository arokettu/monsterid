<?php

require __DIR__ . '/../src/monsterid.php';

use function \SandFoxIM\MonsterID\build_monster;

$image = build_monster('sandfox@sandfox.im');

file_put_contents('avatar.png', $image);
