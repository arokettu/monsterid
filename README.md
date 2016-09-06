# MonsterID

[![Code Climate](https://codeclimate.com/github/sandfoxme/monsterid/badges/gpa.svg)](https://codeclimate.com/github/sandfoxme/monsterid)

monsterid was inspired by a post by 
[Don Park](http://www.docuverse.com/blog/donpark/2007/01/18/visual-security-9-block-ip-identification) 
and the [Combinatoric Critters](http://www.levitated.net/bones/walkingFaces/index.html).

All graphics were created by [Andreas Gohr](http://www.splitbrain.org). The source code and the graphics are provided
under the [Creative Commons Attribution 2.5 License](http://creativecommons.org/licenses/by/2.5/)

If you use this software and/or graphics please link back to http://www.splitbrain.org/go/monsterid

## Usage

Install it with Composer

```json
"require": {
    "sandfox-im/monsterid": "*"
}
```

and just use ```build_monster(id, size)``` from the ```SandFoxIM\MonsterID``` namespace

```php
// use function is available for PHP >= 5.6, call with full namespace in earlier versions
use function \SandFoxIM\MonsterID\build_monster;

// make me an avatar
$image = build_monster('sandfox@sandfox.me', 150);

// save it to file
file_put_contents('avatar.png', $image);
```

## Adaptation

Adaptation as a composer library performed by [Anton "Sand Fox" Smirnov](https://sandfox.me/)
