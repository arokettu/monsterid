# MonsterID

[![Packagist](https://img.shields.io/packagist/v/sandfoxme/monsterid.svg)](https://packagist.org/packages/sandfoxme/monsterid)
[![license](https://img.shields.io/github/license/sandfoxme/monsterid.svg)](https://opensource.org/licenses/MIT)
[![Travis](https://img.shields.io/travis/sandfoxme/monsterid.svg)](https://travis-ci.org/sandfoxme/monsterid)
[![Code Climate](https://img.shields.io/codeclimate/c/sandfoxme/monsterid.svg)](https://codeclimate.com/github/sandfoxme/monsterid/coverage)
[![Code Climate](https://img.shields.io/codeclimate/maintainability/sandfoxme/monsterid.svg)](https://codeclimate.com/github/sandfoxme/monsterid)

MonsterID is a method to generate a unique monster image based upon a certain identifier (IP address, email address, whatever). It can be used to automatically provide personal avatar images in blog comments or other community services.

![Monster Example](docs/example.png)

MonsterID was inspired by a post by [Don Park] and the [Combinatoric Critters].

All graphics were created by [Andreas Gohr]. The source code and the graphics are provided under the [MIT License].

## Installation

Install it with Composer

```json
{
    "require": {
        "sandfoxme/monsterid": "^1.1"
    }
}
```

or run `composer require 'sandfoxme/monsterid:^1.1'`.

## Usage

```php
<?php

use \SandFoxMe\MonsterID\Monster;

// use function is available for PHP >= 5.6, call with full namespace in earlier versions
use function \SandFoxMe\MonsterID\build_monster;

// Use function:

$image = build_monster('sandfox@sandfox.me', 150);

// save it to file
file_put_contents('avatar.png', $image);

// Use object:

$monster = new Monster('sandfox@sandfox.me');

// save it to file
file_put_contents('avatar.png', $monster->build(150));
```

## Adaptation

Adaptation as a composer library performed by [Anton "Sand Fox" Smirnov][Sand Fox]

[Don Park]:                 http://www.docuverse.com/blog/donpark/2007/01/18/visual-security-9-block-ip-identification
[Combinatoric Critters]:    http://www.levitated.net/bones/walkingFaces/index.html
[Andreas Gohr]:             http://www.splitbrain.org
[MIT License]:              https://opensource.org/licenses/MIT
[Sand Fox]:                 https://sandfox.me/
