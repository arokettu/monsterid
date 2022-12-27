<?php

namespace SandFox\MonsterID\Future;

const NS = 'SandFox\\MonsterID\\';
const PREFIX_1 = 'Arokettu\\MonsterID\\';
const PREFIX_1_LEN = 19;
const PREFIX_2 = 'SandFoxMe\\MonsterID\\';
const PREFIX_2_LEN = 20;

spl_autoload_register(function ($class_name) {
    if (strncmp($class_name, PREFIX_1, PREFIX_1_LEN) === 0) {
        $realName = NS . substr($class_name, PREFIX_1_LEN);
        class_alias($realName, $class_name);
        return true;
    }

    if (strncmp($class_name, PREFIX_2, PREFIX_2_LEN) === 0) {
        $realName = NS . substr($class_name, PREFIX_2_LEN);
        class_alias($realName, $class_name);
        return true;
    }

    return null;
});
