CSSqueeze: Efficient CSS minification in PHP
==================================================

*  [![Build Status](https://travis-ci.org/ianbogda/CSSqueeze.png?branch=master)](https://travis-ci.org/ianbogda/CSSqueeze)
*  [![Coverage Status](https://coveralls.io/repos/ianbogda/CSSqueeze/badge.png)](https://coveralls.io/r/ianbogda/CSSqueeze)
*  [![Code Coverage](https://scrutinizer-ci.com/g/ianbogda/CSSqueeze/badges/coverage.png?s=dac1996f32de040657203c458bd96aea79b390c7)](https://scrutinizer-ci.com/g/ianbogda/CSSqueeze/)
*  [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/ianbogda/CSSqueeze/badges/quality-score.png?s=484130f5adab9ca8ce1dfab522a52406c0b336e2)](https://scrutinizer-ci.com/g/ianbogda/CSSqueeze/)

CSSqueeze …

It's a single PHP class licensed under Apache 2 and GPLv2.

Features
--------

*  Remove white space and extra characters
  * whitespace
  * Last semicolon in a statement
  * Measurement units for the values (eg margin: 0px -> margin: 0)
  * Comments (preserving ```/*! important comments */```)
  * Empty statements (eg p {})
* Use shorthand properties
  * margin
  * padding
  * border
  * outline
  * list-style
  * background (eg instead of background-color) 
* Compress colors
  * Use short notations of hexadecimal colors (Ex: color: # ff6600 becomes color: # f60;). Use colors supported in CSS 2 whose name is shorter than the hexadecimal.
* Sorting CSS properties
* Merge properties
* merge rules if required

Todo
----
Compare with others CSS minifiers

* preserving the CSS hack
* Add vendor prefix
* More shorthands
* rgba(
* change hack throught html class

Vendors Prefix
--------------

* -o- Opera
* -moz- Gecko (Mozilla)
* -webkit- Webkit (Chrome, Safari, Android...)
* -ms-/mso- (Internet Explorer)
* -khtml- KHTML (Konqueror)
