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

.. warning:: Version 2.0.0 uses bad random generation and therefore is not recommended

Documentation
=============

.. toctree::

    usage
    upgrade

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
