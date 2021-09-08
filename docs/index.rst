MonsterID
#########

|Packagist| |GitLab| |GitHub| |Bitbucket| |Gitea|

MonsterID is a method to generate a unique monster image based upon a certain identifier
(IP address, email address, whatever).
It can be used to automatically provide personal avatar images in blog comments or other community services.

|Monster Example|

.. |Monster Example| image:: images/example.png

MonsterID was inspired by a post by `Don Park`_ and the `Combinatoric Critters`_.

Installation
============

Install it with Composer

.. code:: bash

   composer require 'sandfoxme/monsterid:^2.1'

.. warning:: Version 2.0.0 uses bad random generation and is therefore not recommended

Usage
=====

Function-style
--------------

Get PNG as a string:

.. code-block:: php

    <?php

    use function SandFox\MonsterID\build_monster;

    // output to browser
    header('Content-type: image/png');
    echo build_monster('email@example.com', 150);

Put PNG to a stream:

.. code-block:: php

    <?php

    use function SandFox\MonsterID\stream_monster;

    // save to file
    $stream = fopen('avatar.png', 'w');
    stream_monster($stream, 'email@example.com', 150);
    fclose($stream);

Export GD object:

.. code-block:: php

    <?php

    use function SandFox\MonsterID\build_monster_gd;

    // convert it to a different format for example
    $gd = build_monster_gd('email@example.com', 150); // a copy of the internal gd object
    header('Content-type: image/avif');
    imageavif($gd);
    imagedestroy($gd); // it's your responsibility to destroy the resource (PHP < 8.0)

Object-style
------------

.. code-block:: php

    <?php

    use SandFox\MonsterID\Monster;

    $monster = new Monster('email@example.com', 150);

    // output it to browser
    header('Content-type: image/png');
    echo $monster->getImage();

    // save it to file
    $monster->writeToStream(fopen('avatar.png', 'w'));

    // gd
    header('Content-type: image/avif');
    imageavif($monster->getGdImage());

Upgrade from 1.x
================

* Expect different images to be generated
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

License
=======

All graphics were created by `Andreas Gohr`_.
The source code and the graphics are provided under the `MIT License`_.

Upgraded and maintained by `Anton "Sand Fox" Smirnov <SandFox_>`_.

Original implementation can be found `here <upstream_>`_.

.. _Don Park:               http://www.docuverse.com/blog/donpark/2007/01/18/visual-security-9-block-ip-identification
.. _Combinatoric Critters:  http://www.levitated.net/bones/walkingFaces/index.html
.. _Andreas Gohr:           http://www.splitbrain.org
.. _MIT License:            https://opensource.org/licenses/MIT
.. _SandFox:                https://sandfox.me/
.. _upstream:               https://github.com/splitbrain/monsterID

.. |Packagist|  image:: https://img.shields.io/packagist/v/sandfoxme/monsterid.svg?style=flat-square
   :target:     https://packagist.org/packages/sandfoxme/monsterid
.. |GitHub|     image:: https://img.shields.io/badge/get%20on-GitHub-informational.svg?style=flat-square&logo=github
   :target:     https://github.com/arokettu/monsterid
.. |GitLab|     image:: https://img.shields.io/badge/get%20on-GitLab-informational.svg?style=flat-square&logo=gitlab
   :target:     https://gitlab.com/sandfox/monsterid
.. |Bitbucket|  image:: https://img.shields.io/badge/get%20on-Bitbucket-informational.svg?style=flat-square&logo=bitbucket
   :target:     https://bitbucket.org/sandfox/monsterid
.. |Gitea|      image:: https://img.shields.io/badge/get%20on-Gitea-informational.svg?style=flat-square&logo=gitea
   :target:     https://sandfox.org/sandfox/monsterid
