Upgrade Notes
#############

.. highlight:: php

Upgrade from 2.x
================

* The package was renamed to ``arokettu/monsterid``

  * Old versions were published under the new name without any changes
* The namespace was changed to ``Arokettu\MonsterID``

  * 1.4.0 and 2.3.0 were released with ``Arokettu\MonsterID`` support for old branches
* V3 generator is now default

  * Pass V2 generator explicilty or set it in global config::

        <?php

        use Arokettu\MonsterID\Config;
        use Arokettu\MonsterID\Randomizer\DefaultV2Factory;

        use function Arokettu\MonsterID\build_monster;

        require 'vendor/autoload.php';

        build_monster('my@email', rngFactory: new DefaultV2Factory());

        // or

        Config::setRandomizerFactory(new DefaultV2Factory());

* ``build()`` method was removed

Upgrade from 1.x
================

* Expect different images to be generated

  * Use V1 RNG factory in MonsterID 2.2+ for partial compatibility
* Namespace ``SandFoxMe\MonsterID`` is removed, use ``SandFox\MonsterID``
* Object style changes::

        <?php

        use SandFox\MonsterID\Monster;

        // 1.x (deprecated in 1.3.0, removed in 3.0.0)
        (new Monster('email@example.com'))->build(150);
        // 2.x
        (new Monster('email@example.com', 150))->getImage();

  * Size parameter moved to the constructor
  * ``build()`` is now ``getImage()``
