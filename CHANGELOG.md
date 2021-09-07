# Changelog

## 1.3.0

*Sep 7, 2021*

* Added default `$size` to the constructor for forward compatibility with 2.0
* Added `getImage()` method for forward compatibility with 2.0
* Deprecated `build()` method. It will be removed in 2.0

## 1.2.0

*Apr 9, 2019*

* Changed base namespace to SandFox

## 1.1.1

*Apr 3, 2018*

* Relicensed to MIT to sync with upstream [[Github#1]]
* Shrinked zip package a bit by adding some development files to .gitattributes

## 1.1.0

*Dec 12, 2017*

* Added Monster object for OOP style calls
* Added protection from possible resource leaks
* Bumped PHP requirement to 5.5 due fo usage of `finally`

## 1.0.2

*Dec 10, 2017*

* Change composer library name from ```sandfox-im/monsterid``` to ```sandfoxme/monsterid```
* Change namespace from ```SandFoxIM\MonsterID``` to ```SandFoxMe\MonsterID```

As the library seems unused currently, the old package will be just deleted from packagist

## 1.0.1

*Oct 30, 2015*

replaced one last missed die() with exception

## 1.0.0 "Halloween"

*Oct 30, 2015*

Initial release

Main differences from vanilla MonsterID:
- function returns png image file content, not sends it to the user
- function is namespaced
- die()'s replaced with exceptions

[Github#1]: https://github.com/sandfoxme/monsterid/issues/1
