<?php

require __DIR__ . '/../src/monsterid.php';

// use function is available for PHP >= 5.6, call with full namespace in earlier versions
use function \SandFoxIM\MonsterID\build_monster;

// make me an avatar
$image = build_monster('sandfox@sandfox.me');

// save it to file
file_put_contents('avatar.png', $image);
