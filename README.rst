MonsterID
=========

.. image::  https://img.shields.io/packagist/v/sandfoxme/monsterid.svg
   :target: https://packagist.org/packages/sandfoxme/monsterid
   :alt:    Packagist
.. image::  https://img.shields.io/github/license/sandfoxme/monsterid.svg
   :target: https://opensource.org/licenses/MIT
   :alt:    license
.. image::  https://img.shields.io/travis/sandfoxme/monsterid.svg
   :target: https://travis-ci.org/sandfoxme/monsterid
   :alt:    Travis
.. image::  https://img.shields.io/codeclimate/c/sandfoxme/monsterid.svg
   :target: https://codeclimate.com/github/sandfoxme/monsterid/coverage
   :alt:    Code Climate Coverage
.. image::  https://img.shields.io/codeclimate/maintainability/sandfoxme/monsterid.svg
   :target: https://codeclimate.com/github/sandfoxme/monsterid
   :alt:    Code Climate

MonsterID is a method to generate a unique monster image based upon a certain identifier
(IP address, email address, whatever).
It can be used to automatically provide personal avatar images in blog comments or other community services.

|Monster Example|

.. |Monster Example| image:: docs/example.png

MonsterID was inspired by a post by `Don Park`_ and the `Combinatoric Critters`_.

All graphics were created by `Andreas Gohr`_.
The source code and the graphics are provided under the `MIT License`_.

Installation
------------

Install it with Composer

.. code:: json

   {
       "require": {
           "sandfoxme/monsterid": "^1.1"
       }
   }

or run ``composer require 'sandfoxme/monsterid:^1.1'``.

Usage
-----

.. code:: php

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

Adaptation
----------

Adaptation as a composer library performed by `Anton "Sand Fox" Smirnov <SandFox_>`_

.. _Don Park:               http://www.docuverse.com/blog/donpark/2007/01/18/visual-security-9-block-ip-identification
.. _Combinatoric Critters:  http://www.levitated.net/bones/walkingFaces/index.html
.. _Andreas Gohr:           http://www.splitbrain.org
.. _MIT License:            https://opensource.org/licenses/MIT
.. _SandFox:                https://sandfox.me/

