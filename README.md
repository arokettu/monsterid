# MonsterID

[![Packagist](https://img.shields.io/packagist/v/sandfoxme/monsterid.svg?maxAge=2592000)](https://packagist.org/packages/sandfoxme/monsterid)
[![Packagist](https://img.shields.io/packagist/l/sandfoxme/monsterid.svg?maxAge=2592000)](https://creativecommons.org/licenses/by/2.5/)
[![Travis](https://img.shields.io/travis/sandfoxme/monsterid.svg?maxAge=2592000)](https://travis-ci.org/sandfoxme/monsterid)
[![Code Climate](https://img.shields.io/codeclimate/coverage/github/sandfoxme/monsterid.svg?maxAge=2592000)](https://codeclimate.com/github/sandfoxme/monsterid/coverage)
[![Code Climate](https://img.shields.io/codeclimate/maintainability/sandfoxme/monsterid.svg?maxAge=2592000)](https://codeclimate.com/github/sandfoxme/monsterid)


monsterid was inspired by a post by 
[Don Park](http://www.docuverse.com/blog/donpark/2007/01/18/visual-security-9-block-ip-identification) 
and the [Combinatoric Critters](http://www.levitated.net/bones/walkingFaces/index.html).

All graphics were created by [Andreas Gohr](http://www.splitbrain.org). The source code and the graphics are provided
under the [Creative Commons Attribution 2.5 License](http://creativecommons.org/licenses/by/2.5/)

If you use this software and/or graphics please link back to http://www.splitbrain.org/go/monsterid

## Installation

Install it with Composer

```json
{
    "require": {
        "sandfoxme/monsterid": "^1.0"
    }
}
```

or run `composer require 'sandfoxme/monsterid:^1.0'`.

## Usage

Just use ```build_monster(id, size)``` from the ```SandFoxMe\MonsterID``` namespace

```php
<?php

// use function is available for PHP >= 5.6, call with full namespace in earlier versions
use function \SandFoxMe\MonsterID\build_monster;

// make me an avatar
$image = build_monster('sandfox@sandfox.me', 150);

// save it to file
file_put_contents('avatar.png', $image);
```

## Adaptation

Adaptation as a composer library performed by [Anton "Sand Fox" Smirnov](https://sandfox.me/)
