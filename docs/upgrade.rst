Upgrade Notes
#############

Upgrade from 1.x
================

* Expect different images to be generated

  * Use V1 RNG factory in MonsterID 2.2+ for partial compatibility
* Namespace ``SandFoxMe\MonsterID`` is removed, use ``SandFox\MonsterID``
* Object style changes

  .. code-block:: php

        <?php

        use SandFox\MonsterID\Monster;

        // 1.x
        (new Monster('email@example.com'))->build(150);
        // 2.x
        (new Monster('email@example.com', 150))->getImage();

  * Size parameter moved to the constructor
  * ``build()`` is now ``getImage()``
