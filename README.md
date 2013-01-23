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
