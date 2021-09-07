# MonsterID

[![Packagist](https://img.shields.io/packagist/v/sandfoxme/monsterid.svg?style=flat-square)](https://packagist.org/packages/sandfoxme/monsterid)
[![license](https://img.shields.io/github/license/sandfoxme/monsterid.svg?style=flat-square)](https://opensource.org/licenses/MIT)
[![Gitlab pipeline status](https://img.shields.io/gitlab/pipeline/sandfox/monsterid/master.svg?style=flat-square)](https://gitlab.com/sandfox/monsterid/-/pipelines)

MonsterID is a method to generate a unique monster image based upon a certain identifier
(IP address, email address, whatever).
It can be used to automatically provide personal avatar images in blog comments or other community services.

![Monster Example](docs/images/example.png)

MonsterID was inspired by a post by [Don Park] and the [Combinatoric Critters].

All graphics were created by [Andreas Gohr].
The source code and the graphics are provided under the [MIT License].

## Installation

Install it with Composer

```bash
composer require sandfoxme/monsterid
```

## Usage

```php
<?php

use function SandFox\MonsterID\build_monster;

header('Content-type: image/png');
echo build_monster('sandfox@sandfox.me', 150);
```

Read full documentation here: <https://sandfox.dev/php/monsterid.html>

Also on Read the Docs: <https://monsterid.readthedocs.io/>

## Adaptation

Adaptation as a composer library performed by [Anton "Sand Fox" Smirnov][SandFox]

[Don Park]:               http://www.docuverse.com/blog/donpark/2007/01/18/visual-security-9-block-ip-identification
[Combinatoric Critters]:  http://www.levitated.net/bones/walkingFaces/index.html
[Andreas Gohr]:           http://www.splitbrain.org
[MIT License]:            https://opensource.org/licenses/MIT
[SandFox]:                https://sandfox.me/
