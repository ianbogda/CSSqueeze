CSSqueeze: Efficient CSS minification in PHP
==================================================

CSSqueeze …

It's a single PHP class licensed under Apache 2 and GPLv2.

Features
--------

*  Remove white space and extra characters
  * whitespace
  * Last semicolon in a statement
  * Measurement units for the values (eg margin: 0px -> margin: 0)
  * Comments (while preserving the CSS hack)
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

Todo
----
Compare with others CSS minifiersa

* Merge properties instead of remove doublons
* Add vendor prefix
* More shorthands
* rgba(
* change hack throught html class
