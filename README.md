CSSqueeze: Efficient CSS minification in PHP
==================================================

[![License](https://poser.pugx.org/patchwork/cssqueeze/license.png)](https://packagist.org/packages/patchwork/cssqueeze)

[![Build Status](https://travis-ci.org/ianbogda/CSSqueeze.png?branch=master)](https://travis-ci.org/ianbogda/CSSqueeze) [![Code Coverage](https://scrutinizer-ci.com/g/ianbogda/CSSqueeze/badges/coverage.png?s=dac1996f32de040657203c458bd96aea79b390c7)](https://scrutinizer-ci.com/g/ianbogda/CSSqueeze/) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/ianbogda/CSSqueeze/badges/quality-score.png?s=484130f5adab9ca8ce1dfab522a52406c0b336e2)](https://scrutinizer-ci.com/g/ianbogda/CSSqueeze/)

[![Latest Stable Version](https://poser.pugx.org/patchwork/cssqueeze/v/stable.png)](https://packagist.org/packages/patchwork/cssqueeze) [![Latest Unstable Version](https://poser.pugx.org/patchwork/cssqueeze/v/unstable.png)](https://packagist.org/packages/patchwork/cssqueeze)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/73a1c49c-2b23-47ad-bdf8-09d1eda7484c/mini.png)](https://insight.sensiolabs.com/projects/73a1c49c-2b23-47ad-bdf8-09d1eda7484c)


CSSqueeze …

It's a single PHP class licensed under Apache 2 and GPLv2.

PHP
---
*  PHP 5.3
*  PHP 5.4
*  PHP 5.5

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
* @import CSS
* @media queries CSS

Compare few minifiers
---------------------

ranking is by _after compression and gzipped_, _after compression_

file compressed : [002/002.css from csszengarden.com](http://csszengarden.com/002/002.css)
<table>
<thead>
  <tr>
    <td>&nbsp;</td> <td>origin</td> <td>after compression</td> <td>saved</td> <td>compression ratio</td> <td>after compression and gzipped</td> <td>compression and gzip ratio
</td>
  </tr>
</thead>
<tbody>
  <tr>
    <td>CSSqueeze</td> <td>5547</td> <td>2862</td> <td>2685</td> <td>48,40%</td> <td>919</td> <td>83,43%</td>
  </tr>
  <tr>
    <td >csscompressor</td> <td>5547</td> <td>2863</td> <td>2684</td> <td>48,39%</td> <td>920</td> <td>83,41%</td>
  </tr>
  <tr>
    <td>YUI</td> <td>5547</td> <td>2902</td> <td>2645</td> <td>47,68%</td> <td>920</td> <td>83,41%</td>
  </tr>
  <tr>
    <td>excssive.com</td> <td>5547</td> <td>2861</td> <td>2686</td> <td>48,42%</td> <td>924</td> <td>83,34%</td>
  </tr>
  <tr>
    <td>cssminifier.com</td> <td>5547</td> <td>2875</td> <td>2672</td> <td>48,17%</td> <td>925</td> <td>83,32%</td>
  </tr>
  <tr>
    <td>cssdrive.com</td> <td>5547</td> <td>2964</td> <td>2583</td> <td>46,57%</td> <td>934</td> <td>83,16%</td>
  </tr>
  <tr>
    <td>minifycss.com</td> <td>5547</td> <td>2894</td> <td>2653</td> <td>47,83%</td> <td>936</td> <td>83,13%</td>
  </tr>
</tbody>
</table>


Todo
----

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
