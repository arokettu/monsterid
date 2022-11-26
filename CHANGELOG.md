# Changelog

## 2.2.0

*Nov 26, 2022*

* Custom sequence generators
  * V1 compatible-ish
  * Future compatible V3
  * Current one is designated as V2
  * Users can create a custom one, compatible with PHP ext-random

## 2.1.2

*Nov 30, 2021*

* Allow symfony/contracts v3

## 2.1.1

*Sep 25, 2021*

* The resource type is now properly checked before writing to it

## 2.1.0

*Sep 8, 2021*

* Fixed random generation

## 2.0.0

*Sep 7, 2021*

!!! Random generation in this version is terrible, please don't use it

* PHP version bumped to 7.1
* New randomization algorithm that does not use `rand()` / `srand()` functions and does not alter global random state.
  This algorithm will generate images that are different from 1.x results
* Monster object is now immutable and serializable
* New functions: `stream_monster()` and `build_monster_gd()`
* New object methods: `getImage`, `writeToStream()`, `getGdImage()`
* `build()` now triggers deprecation warning

## 1.3.0

*Sep 7, 2021*

* Added default `$size` to the constructor for forward compatibility with 2.0
* Added `getImage()` method for forward compatibility with 2.0
* Deprecated `build()` method. It will be removed in ~~2.0~~ 3.0

## 1.2.0

*Apr 9, 2019*

* Changed base namespace to SandFox

## 1.1.1

*Apr 3, 2018*

* Relicensed to MIT to sync with upstream [[Github#1]]
* Shrinked zip package a bit by adding some development files to .gitattributes

[Github#1]: https://github.com/sandfoxme/monsterid/issues/1

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

Main differences from [vanilla MonsterID][upstream]:
- function returns png image file content, not sends it to the user
- function is namespaced
- die()'s replaced with exceptions

[upstream]: https://github.com/splitbrain/monsterID
