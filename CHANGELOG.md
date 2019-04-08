# Changelog

## 1.2.0

_Apr 9, 2019_

* Changed base namespace to SandFox

## 1.1.1

_Apr 3, 2018_

* Relicensed to MIT to sync with upstream [[Github#1]]
* Shrinked zip package a bit by adding some development files to .gitattributes

## 1.1.0

_Dec 12, 2017_

* Added Monster object for OOP style calls
* Added protection from possible resource leaks
* Bumped PHP requirement to 5.5 due fo usage of `finally`

## 1.0.2

_Dec 10, 2017_

* Change composer library name from ```sandfox-im/monsterid``` to ```sandfoxme/monsterid```
* Change namespace from ```SandFoxIM\MonsterID``` to ```SandFoxMe\MonsterID```

As the library seems unused currently, the old package will be just deleted from packagist

## 1.0.1

_Oct 30, 2015_

replaced one last missed die() with exception

## 1.0.0 "Halloween"

_Oct 30, 2015_

Initial release

Main differences from vanilla MonsterID:
- function returns png image file content, not sends it to the user
- function is namespaced
- die()'s replaced with exceptions

[Github#1]: https://github.com/sandfoxme/monsterid/issues/1
