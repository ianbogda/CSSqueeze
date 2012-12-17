<?php // vi: set fenc=utf-8 ts=4 sw=4 et:
//TODO: rgba
//TODO: vendor prefix
//TODO: more shorthands
/*
 * Copyright (C) 2012 Yann Bogdanovic - ianbogda@gmail.com
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the (at your option):
 * Apache License v2.0 (http://apache.org/licenses/LICENSE-2.0.txt), or
 * GNU General Public License v2.0 (http://gnu.org/licenses/gpl-2.0.txt).
 */

class CSSqueeze
{
	protected

	$units          = array('in','cm','mm','pt','pc','px','rem','em','%','ex','gd','vw','vh','vm','deg','grad','rad','ms','s','khz','hz'),
	$prop_values    = array(
		'background',       'background-position', 'background-size',
		'border',           'border-top',          'border-right',      'border-bottom',       'border-left', 'border-width',
		'border-top-width', 'border-right-width',  'border-left-width', 'border-bottom-width', 'bottom',      'border-spacing',
		'column-gap',       'column-width',        'font-size',         'height',              'left',        'margin',
		'margin-top',       'margin-right',        'margin-bottom',     'margin-left',         'max-height',  'max-width',
		'min-height',       'min-width',           'outline',           'outline-width',       'padding',     'padding-top',
		'padding-right',    'padding-bottom',      'padding-left',      'perspective',         'right',       'top',
		'text-indent',      'letter-spacing',      'word-spacing',      'width',
	),
	$fontSize       = array('xx-small', 'x-small', 'small', 'medium', 'large', 'x-large', 'xx-large', 'smaller', 'larger', 'inherit'),
	$fontStyle      = array('normal', 'italic', 'oblique', 'inherit'),
	$color_values   = array(
		'background-color', 'border-color', 'border-top-color', 'border-right-color', 'border-bottom-color',
		'border-left-color', 'color',       'outline-color',    'column-rule-color',
	),
	$listeStyleType = array(
		'armenian',       'circle',      'cjk-ideographic', 'decimal',        'decimal-leading-zero', 'disc',
		'georgian',       'hebrew',      'hiragana',        'hiragana-iroha', 'inherit',              'katakana',
		'katakana-iroha', 'lower-alpha', 'lower-greek',     'lower-latin',    'lower-roman',          'none',
		'square',         'upper-alpha', 'upper-latin',     'upper-roman',
	),
	$replace_colors =  array(
		'aliceblue'         => '#F0F8FF', 'antiquewhite'         => '#FAEBD7', 'aquamarine'      => '#7FFFD4',
		'azure'             => '#F0FFFF', 'beige'                => '#F5F5DC', 'bisque'          => '#FFE4C4',
		'blanchedalmond'    => '#FFEBCD', 'blueviolet'           => '#8A2BE2', 'brown'           => '#A52A2A',
		'burlywood'         => '#DEB887', 'cadetblue'            => '#5F9EA0', 'chartreuse'      => '#7FFF00',
		'chocolate'         => '#D2691E', 'coral'                => '#FF7F50', 'cornflowerblue'  => '#6495ED',
		'cornsilk'          => '#FFF8DC', 'crimson'              => '#DC143C', 'cyan'            => '#00FFFF',
		'darkblue'          => '#00008B', 'darkcyan'             => '#008B8B', 'darkgoldenrod'   => '#B8860B',
		'darkgray'          => '#A9A9A9', 'darkgreen'            => '#006400', 'darkkhaki'       => '#BDB76B',
		'darkmagenta'       => '#8B008B', 'darkolivegreen'       => '#556B2F', 'darkorange'      => '#FF8C00',
		'darkorchid'        => '#9932CC', 'darkred'              => '#8B0000', 'darksalmon'      => '#E9967A',
		'darkseagreen'      => '#8FBC8F', 'darkslateblue'        => '#483D8B', 'darkslategray'   => '#2F4F4F',
		'darkturquoise'     => '#00CED1', 'darkviolet'           => '#9400D3', 'deeppink'        => '#FF1493',
		'deepskyblue'       => '#00BFFF', 'dimgray'              => '#696969', 'dodgerblue'      => '#1E90FF',
		'feldspar'          => '#D19275', 'firebrick'            => '#B22222', 'floralwhite'     => '#FFFAF0',
		'forestgreen'       => '#228B22', 'gainsboro'            => '#DCDCDC', 'ghostwhite'      => '#F8F8FF',
		'gold'              => '#FFD700', 'goldenrod'            => '#DAA520', 'greenyellow'     => '#ADFF2F',
		'honeydew'          => '#F0FFF0', 'hotpink'              => '#FF69B4', 'indianred'       => '#CD5C5C',
		'indigo'            => '#4B0082', 'ivory'                => '#FFFFF0', 'khaki'           => '#F0E68C',
		'lavender'          => '#E6E6FA', 'lavenderblush'        => '#FFF0F5', 'lawngreen'       => '#7CFC00',
		'lemonchiffon'      => '#FFFACD', 'lightblue'            => '#ADD8E6', 'lightcoral'      => '#F08080',
		'lightcyan'         => '#E0FFFF', 'lightgoldenrodyellow' => '#FAFAD2', 'lightgrey'       => '#D3D3D3',
		'lightgreen'        => '#90EE90', 'lightpink'            => '#FFB6C1', 'lightsalmon'     => '#FFA07A',
		'lightseagreen'     => '#20B2AA', 'lightskyblue'         => '#87CEFA', 'lightslateblue'  => '#8470FF',
		'lightslategray'    => '#778899', 'lightsteelblue'       => '#B0C4DE', 'lightyellow'     => '#FFFFE0',
		'limegreen'         => '#32CD32', 'linen'                => '#FAF0E6', 'magenta'         => '#FF00FF',
		'mediumaquamarine'  => '#66CDAA', 'mediumblue'           => '#0000CD', 'mediumorchid'    => '#BA55D3',
		'mediumpurple'      => '#9370D8', 'mediumseagreen'       => '#3CB371', 'mediumslateblue' => '#7B68EE',
		'mediumspringgreen' => '#00FA9A', 'mediumturquoise'      => '#48D1CC', 'mediumvioletred' => '#C71585',
		'midnightblue'      => '#191970', 'mintcream'            => '#F5FFFA', 'mistyrose'       => '#FFE4E1',
		'moccasin'          => '#FFE4B5', 'navajowhite'          => '#FFDEAD', 'oldlace'         => '#FDF5E6',
		'olivedrab'         => '#6B8E23', 'orangered'            => '#FF4500', 'orchid'          => '#DA70D6',
		'palegoldenrod'     => '#EEE8AA', 'palegreen'            => '#98FB98', 'paleturquoise'   => '#AFEEEE',
		'palevioletred'     => '#D87093', 'papayawhip'           => '#FFEFD5', 'peachpuff'       => '#FFDAB9',
		'peru'              => '#CD853F', 'pink'                 => '#FFC0CB', 'plum'            => '#DDA0DD',
		'powderblue'        => '#B0E0E6', 'rosybrown'            => '#BC8F8F', 'royalblue'       => '#4169E1',
		'saddlebrown'       => '#8B4513', 'salmon'               => '#FA8072', 'sandybrown'      => '#F4A460',
		'seagreen'          => '#2E8B57', 'seashell'             => '#FFF5EE', 'sienna'          => '#A0522D',
		'skyblue'           => '#87CEEB', 'slateblue'            => '#6A5ACD', 'slategray'       => '#708090',
		'snow'              => '#FFFAFA', 'springgreen'          => '#00FF7F', 'steelblue'       => '#4682B4',
		'tan'               => '#D2B48C', 'thistle'              => '#D8BFD8', 'tomato'          => '#FF6347',
		'turquoise'         => '#40E0D0', 'violet'               => '#EE82EE', 'violetred'       => '#D02090',
		'wheat'             => '#F5DEB3', 'whitesmoke'           => '#F5F5F5', 'yellowgreen'     => '#9ACD32'
	),
	$shorthands = array(
		'border-color'  => array('border-top-color', 'border-right-color', 'border-bottom-color', 'border-left-color',),
		'border-style'  => array('border-top-style', 'border-right-style', 'border-bottom-style', 'border-left-style',),
		'border-width'  => array('border-top-width', 'border-right-width', 'border-bottom-width', 'border-left-width',),
		'border'        => array('border-top',       'border-right',       'border-bottom',       'border-left',),
		'margin'        => array('margin-top',       'margin-right',       'margin-bottom',       'margin-left',),
		'padding'       => array('padding-top',      'padding-right',      'padding-bottom',      'padding-left',),
		'border-radius' => 0
	),
	$fontWeight = array('normal', 'bold', 'bolder', 'lighter', '100', '200', '300', '400', '500', '600', '700', '800', '900', 'inherit'),
	$properties = array(
		'position',
		'top',
		'right',
		'bottom',
		'left',
		'z-index',
		'display',
		'visibility',
		'-webkit-flex-direction',
		'-moz-flex-direction',
		'-ms-flex-direction',
		'-o-flex-direction',
		'flex-direction',
		'-webkit-flex-order',
		'-moz-flex-order',
		'-ms-flex-order',
		'-o-flex-order',
		'flex-order',
		'-webkit-flex-pack',
		'-moz-flex-pack',
		'-ms-flex-pack',
		'-o-flex-pack',
		'flex-pack',
		'float',
		'clear',
		'-webkit-flex-align',
		'-moz-flex-align',
		'-ms-flex-align',
		'-o-flex-align',
		'flex-align',
		'overflow',
		'-ms-overflow-x',
		'-ms-overflow-y',
		'overflow-x',
		'overflow-y',
		'clip',
		'-webkit-box-sizing',
		'-moz-box-sizing',
		'box-sizing',
		'margin',
		'margin-top',
		'margin-right',
		'margin-bottom',
		'margin-left',
		'padding',
		'padding-top',
		'padding-right',
		'padding-bottom',
		'padding-left',
		'min-width',
		'min-height',
		'max-width',
		'max-height',
		'width',
		'height',
		'outline',
		'outline-width',
		'outline-style',
		'outline-color',
		'outline-offset',
		'border',
		'border-spacing',
		'border-collapse',
		'border-width',
		'border-style',
		'border-color',
		'border-top',
		'border-top-width',
		'border-top-style',
		'border-top-color',
		'border-right',
		'border-right-width',
		'border-right-style',
		'border-right-color',
		'border-bottom',
		'border-bottom-width',
		'border-bottom-style',
		'border-bottom-color',
		'border-left',
		'border-left-width',
		'border-left-style',
		'border-left-color',
		'-webkit-border-radius',
		'-moz-border-radius',
		'border-radius',
		'-webkit-border-top-left-radius',
		'-moz-border-radius-topleft',
		'border-top-left-radius',
		'-webkit-border-top-right-radius',
		'-moz-border-radius-topright',
		'border-top-right-radius',
		'-webkit-border-bottom-right-radius',
		'-moz-border-radius-bottomright',
		'border-bottom-right-radius',
		'-webkit-border-bottom-left-radius',
		'-moz-border-radius-bottomleft',
		'border-bottom-left-radius',
		'-webkit-border-image',
		'-moz-border-image',
		'-o-border-image',
		'border-image',
		'-webkit-border-image-source',
		'-moz-border-image-source',
		'-o-border-image-source',
		'border-image-source',
		'-webkit-border-image-slice',
		'-moz-border-image-slice',
		'-o-border-image-slice',
		'border-image-slice',
		'-webkit-border-image-width',
		'-moz-border-image-width',
		'-o-border-image-width',
		'border-image-width',
		'-webkit-border-image-outset',
		'-moz-border-image-outset',
		'-o-border-image-outset',
		'border-image-outset',
		'-webkit-border-image-repeat',
		'-moz-border-image-repeat',
		'-o-border-image-repeat',
		'border-image-repeat',
		'-webkit-border-top-image',
		'-moz-border-top-image',
		'-o-border-top-image',
		'border-top-image',
		'-webkit-border-right-image',
		'-moz-border-right-image',
		'-o-border-right-image',
		'border-right-image',
		'-webkit-border-bottom-image',
		'-moz-border-bottom-image',
		'-o-border-bottom-image',
		'border-bottom-image',
		'-webkit-border-left-image',
		'-moz-border-left-image',
		'-o-border-left-image',
		'border-left-image',
		'-webkit-border-corner-image',
		'-moz-border-corner-image',
		'-o-border-corner-image',
		'border-corner-image',
		'-webkit-border-top-left-image',
		'-moz-border-top-left-image',
		'-o-border-top-left-image',
		'border-top-left-image',
		'-webkit-border-top-right-image',
		'-moz-border-top-right-image',
		'-o-border-top-right-image',
		'border-top-right-image',
		'-webkit-border-bottom-right-image',
		'-moz-border-bottom-right-image',
		'-o-border-bottom-right-image',
		'border-bottom-right-image',
		'-webkit-border-bottom-left-image',
		'-moz-border-bottom-left-image',
		'-o-border-bottom-left-image',
		'border-bottom-left-image',
		'background',
		'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader',
		'background-color',
		'background-image',
		'background-attachment',
		'background-position',
		'-ms-background-position-x',
		'-ms-background-position-y',
		'background-position-x',
		'background-position-y',
		'background-clip',
		'background-origin',
		'background-size',
		'background-repeat',
		'box-decoration-break',
		'-webkit-box-shadow',
		'-moz-box-shadow',
		'box-shadow',
		'color',
		'table-layout',
		'caption-side',
		'empty-cells',
		'list-style',
		'list-style-position',
		'list-style-type',
		'list-style-image',
		'quotes',
		'content',
		'counter-increment',
		'counter-reset',
		'-ms-writing-mode',
		'vertical-align',
		'text-align',
		'-webkit-text-align-last',
		'-moz-text-align-last',
		'-ms-text-align-last',
		'text-align-last',
		'text-decoration',
		'text-emphasis',
		'text-emphasis-position',
		'text-emphasis-style',
		'text-emphasis-color',
		'text-indent',
		'-ms-text-justify',
		'text-justify',
		'text-outline',
		'text-transform',
		'text-wrap',
		'-ms-text-overflow',
		'text-overflow',
		'text-overflow-ellipsis',
		'text-overflow-mode',
		'text-shadow',
		'white-space',
		'word-spacing',
		'-ms-word-wrap',
		'word-wrap',
		'-ms-word-break',
		'word-break',
		'-moz-tab-size',
		'-o-tab-size',
		'tab-size',
		'-webkit-hyphens',
		'-moz-hyphens',
		'hyphens',
		'letter-spacing',
		'font',
		'font-weight',
		'font-style',
		'font-variant',
		'font-size-adjust',
		'font-stretch',
		'font-size',
		'font-family',
		'src',
		'line-height',
		'opacity',
		'-ms-filter:\'progid:DXImageTransform.Microsoft.Alpha',
		'filter:progid:DXImageTransform.Microsoft.Alpha(Opacity',
		'-ms-interpolation-mode',
		'-webkit-filter',
		'-ms-filter',
		'filter',
		'resize',
		'cursor',
		'nav-index',
		'nav-up',
		'nav-right',
		'nav-down',
		'nav-left',
		'-webkit-transition',
		'-moz-transition',
		'-ms-transition',
		'-o-transition',
		'transition',
		'-webkit-transition-delay',
		'-moz-transition-delay',
		'-ms-transition-delay',
		'-o-transition-delay',
		'transition-delay',
		'-webkit-transition-timing-function',
		'-moz-transition-timing-function',
		'-ms-transition-timing-function',
		'-o-transition-timing-function',
		'transition-timing-function',
		'-webkit-transition-duration',
		'-moz-transition-duration',
		'-ms-transition-duration',
		'-o-transition-duration',
		'transition-duration',
		'-webkit-transition-property',
		'-moz-transition-property',
		'-ms-transition-property',
		'-o-transition-property',
		'transition-property',
		'-webkit-transform',
		'-moz-transform',
		'-ms-transform',
		'-o-transform',
		'transform',
		'-webkit-transform-origin',
		'-moz-transform-origin',
		'-ms-transform-origin',
		'-o-transform-origin',
		'transform-origin',
		'-webkit-animation',
		'-moz-animation',
		'-ms-animation',
		'-o-animation',
		'animation',
		'-webkit-animation-name',
		'-moz-animation-name',
		'-ms-animation-name',
		'-o-animation-name',
		'animation-name',
		'-webkit-animation-duration',
		'-moz-animation-duration',
		'-ms-animation-duration',
		'-o-animation-duration',
		'animation-duration',
		'-webkit-animation-play-state',
		'-moz-animation-play-state',
		'-ms-animation-play-state',
		'-o-animation-play-state',
		'animation-play-state',
		'-webkit-animation-timing-function',
		'-moz-animation-timing-function',
		'-ms-animation-timing-function',
		'-o-animation-timing-function',
		'animation-timing-function',
		'-webkit-animation-delay',
		'-moz-animation-delay',
		'-ms-animation-delay',
		'-o-animation-delay',
		'animation-delay',
		'-webkit-animation-iteration-count',
		'-moz-animation-iteration-count',
		'-ms-animation-iteration-count',
		'-o-animation-iteration-count',
		'animation-iteration-count',
		'-webkit-animation-direction',
		'-moz-animation-direction',
		'-ms-animation-direction',
		'-o-animation-direction',
		'animation-direction',
		'pointer-events',
		'unicode-bidi',
		'direction',
		'-webkit-columns',
		'-moz-columns',
		'columns',
		'-webkit-column-span',
		'-moz-column-span',
		'column-span',
		'-webkit-column-width',
		'-moz-column-width',
		'column-width',
		'-webkit-column-count',
		'-moz-column-count',
		'column-count',
		'-webkit-column-fill',
		'-moz-column-fill',
		'column-fill',
		'-webkit-column-gap',
		'-moz-column-gap',
		'column-gap',
		'-webkit-column-rule',
		'-moz-column-rule',
		'column-rule',
		'-webkit-column-rule-width',
		'-moz-column-rule-width',
		'column-rule-width',
		'-webkit-column-rule-style',
		'-moz-column-rule-style',
		'column-rule-style',
		'-webkit-column-rule-color',
		'-moz-column-rule-color',
		'column-rule-color',
		'break-before',
		'break-inside',
		'break-after',
		'page-break-before',
		'page-break-inside',
		'page-break-after',
		'orphans',
		'widows',
		'-ms-zoom',
		'zoom',
		'max-zoom',
		'min-zoom',
		'user-zoom',
		'orientation',
/* Speech */
		'volume',
		'speak',
		'pause',
		'pause-before',
		'pause-after',
		'cue',
		'cue-before',
		'cue-after',
		'play-during',
		'azimuth',
		'elevation',
		'speech-rate',
		'voice-family',
		'pitch',
		'pitch-range',
		'stress',
		'richness',
		'speak-punctuation',
		'speak-numeral'
	);

	function __construct()
	{
		$this->properties   = array_flip($this->properties  );
		$this->prop_values  = array_flip($this->prop_values );
		$this->color_values = array_flip($this->color_values);
	}

	/**
	 * Squeezes a Cascade Style Sheet source code.
	 *
	 * Set $singleLine to false if you want optional
	 * semi-colons to be replaced by line feeds.
	 *
	 * Set $sort to false if you doesn't want sort your properties.
	 *
	 * Example:
	 * $parser = new CSSqueeze;
	 * $squeezed_css = $parser->squeeze($fat_css);
	 */

	function squeeze($css, $singleLine = true)
	{
		$css = trim($css);
		if ('' === $css) return '';

		list($selectors, $blocks) = $this->tokenize($css);

		$f = '';
		foreach($selectors as $k => $v)
		{
			$f .= $v . '{' . $blocks[$k] . '}';
		}

		return $singleLine ? $this->compress($f) : $this->deflat($f);
	}

	protected function tokenize($lines)
	{
		$css = '';
		$token = array();

		$lines = preg_split("/\n/", $lines);
		foreach($lines as $num => $line)
		{
 			$css .= trim($line);
		}

		$token = strtok($css, "{}");

		$rules = array();
		$pos = 0;

		while ($token !== false)
		{
 			$rules[$pos] = $token;
			++$pos;
			$token = strtok('{}');
		}

 		$size = count($rules);

		$selectors = $blocks = array();
		$spos = $bpos = 0;

		for ($i = 0; $i<$size; ++$i)
		{
			if ($i % 2 == 0)
			{
				$selectors[$spos] = $rules[$i];
				++$spos;
			}
			else
			{
				$blocks[$bpos] = $rules[$i];
				++$bpos;
			}
		}

		return array($selectors, $blocks);
	}

	protected function compress($f)
	{
		$units = implode('|', $this->units);

		/* 0.1em => .1em */
		$p[] = "#(-?)0\.(\d+({$units}))#";
		$r[] = '$1.$2';

		/* 0px => 0 */
		$p[] = "#([\s]|:)0({$units})#";
		$r[] = '${1}0';

		/* Removing unnecessary decimal*/
		$p[] = "#:(([^;]*-?[0-9]*)\.|([^;]*-?[0-9]*\.[1-9]+))0+({$units})([^;]*);#";
		$r[] = ':$2$3$4$5;';

		/* remove empty selectors */
		$p[] = '#([^}]+){}#isU';
		$r[] = '';

		/* remove multiline comments */
		$p[] = '/\/\*.*?\*\//s';
		$r[] = '';

		/* remove tabs, spaces, newlines, etc. */
		$p[] = '/\r\n|\r|\n|\t|\s\s+/';
		$r[] = '';

		// Fix url()
		$p[] = '#(url|rgba|rgb|hsl|hsla|attr)\((.*)\)(\S)#isU';
		$r[] = '$1($2) $3';

		/* remove whitespace on both sides of colons :*/
		$p[] = '/\s?\:\s?/';
		$r[] = ':';

		/* remove whitespace on both sides of curly brackets {} */
		$p[] = '/\s?\{\s?/';
		$r[] = '{';
		$p[] = '/\s?\}\s?/';
		$r[] = '}';

		/* remove whitespace on both sides of commas , */
		$p[] = '/\s?\,\s?/';
		$r[] = ',';

		/* remove multi semi-colons */
		$p[] = '/;+/';
		$r[] = ';';

		/* remove semi-colons before closing curly bracket } */
		$p[] = '/;\}/';
		$r[] = '}';
		
		return preg_replace($p, $r, $f);
	}

	protected function deflat($f, $indent)
	{
		/* add semicolon before curly bracket } and newline after */
		$p[] = '/([}])/';
		$r[] = ";$1\n\n";

		/* add whitespace before curly bracket { */
		$p[] = '/([{])/';
		$r[] = " $1\n";

		/* add newlines after semicolons ; */
		$p[] = '/([;])/';
		$r[] = "$1\n";

		if ($indent)
		{
			$p[] = '/((.*):(.*))/';
			$r[] = $indent . '$1';
		}

		return preg_replace($p, $r, $f);
	}
}

$css = 'p{
  color:#000000;
}
h1{
   font-size:18px;
   color:#666666;
}
/*! important
*/
table{
   width:100%; /* comment */
   border:/**/1px solid #000000;
}';
echo $css;
$p = New CSSqueeze();
print_r($p->squeeze($css));
