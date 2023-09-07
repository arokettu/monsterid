Usage
#####

.. highlight:: php

Simple image generation
=======================

Function-style
--------------

Get PNG as a string::

    <?php

    use function Arokettu\MonsterID\build_monster;

    // output to browser
    header('Content-type: image/png');
    echo build_monster('email@example.com', 150);

Put PNG to a stream::

    <?php

    use function Arokettu\MonsterID\stream_monster;

    // save to file
    $stream = fopen('avatar.png', 'w');
    stream_monster($stream, 'email@example.com', 150);
    fclose($stream);

    // more efficient output to browser
    $stream = fopen('php://temp', 'r+');
    stream_monster($stream, 'email@example.com', 150);
    rewind($stream);
    fpassthru($stream);
    fclose($stream);

Export GD object::

    <?php

    use function Arokettu\MonsterID\build_monster_gd;

    // convert it to a different format for example
    $gd = build_monster_gd('email@example.com', 150); // a copy of the internal gd object
    header('Content-type: image/avif');
    imageavif($gd);
    imagedestroy($gd); // it's your responsibility to destroy the resource (PHP < 8.0)

Monster object
--------------

::

    <?php

    use Arokettu\MonsterID\Monster;

    $monster = new Monster('email@example.com', 150);

    // output it to browser
    header('Content-type: image/png');
    echo $monster->getImage();

    // save it to file
    $monster->writeToStream(fopen('avatar.png', 'w'));

    // gd
    header('Content-type: image/avif');
    imageavif($monster->getGdImage());

Random sequences
================

.. versionadded:: 2.2

The library supports 4 random number generators:

* Version 0: Mersenne Twister based.
  It generates the same images as MonsterID version 1.0 and the original implementation did in PHP 7.2+.
  (7.1 may be glitchy, rand() in earlier versions was not MT based and is not reproducible)
* Version 1: Mersenne Twister based.
  It generates the same images as MonsterID versions 1.1-1.4 did in PHP 7.2+.
* Version 2 (was default in MonsterID 2): Xorshift32 based, as implemented in MonsterID 2.1+
* Version 3 (default): native PHP Xoshiro256** based sequence.

Also the lib provides ``\Arokettu\MonsterID\Randomizer\FactoryInterface`` that you can use to implement your own.

.. note::
    Monster object will be serializable if your factory implementation is.
    All default factories are serializable.

Setting a default factory globally
----------------------------------

::

    <?php

    use Arokettu\MonsterID\Config;
    use Arokettu\MonsterID\Randomizer\DefaultV0Factory;
    use Arokettu\MonsterID\Randomizer\DefaultV1Factory;
    use Arokettu\MonsterID\Randomizer\DefaultV2Factory;
    use Arokettu\MonsterID\Randomizer\DefaultV3Factory;

    Config::setRandomizerFactory(); // reset to default (currently V2)
    Config::setRandomizerFactory(new DefaultV0Factory()); // set V0
    Config::setRandomizerFactory(new DefaultV1Factory()); // set V1
    Config::setRandomizerFactory(new DefaultV2Factory()); // set V2
    Config::setRandomizerFactory(new DefaultV3Factory()); // set V3

All Monster objects created after the config change will use the specified factory if not explicitly passed.

Passing explicitly
------------------

Object constructor and all functions support passing $rngFactory explicitly::

    <?php

    use Arokettu\MonsterID\Monster;
    use Arokettu\MonsterID\Randomizer\DefaultV3Factory;

    use function Arokettu\MonsterID\build_monster;

    use const Arokettu\MonsterID\MONSTER_DEFAULT_SIZE;

    $image = (new Monster('test@example.com', MONSTER_DEFAULT_SIZE, new DefaultV3Factory()))
        ->getImage();
    // or
    $image = build_monster('test@example.com', MONSTER_DEFAULT_SIZE, new DefaultV3Factory());
