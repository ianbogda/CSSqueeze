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
		'text-indent',      'letter-spacing',      'word-spacing',      'width'
	),
	$fontSize       = array('xx-small', 'x-small', 'small', 'medium', 'large', 'x-large', 'xx-large', 'smaller', 'larger', 'inherit'),
	$fontStyle      = array('normal', 'italic', 'oblique', 'inherit'),
	$color_values   = array(
		'background-color', 'border-color', 'border-top-color', 'border-right-color', 'border-bottom-color',
		'border-left-color', 'color',       'outline-color',    'column-rule-color'
	),
	$listeStyleType = array(
		'armenian',       'circle',      'cjk-ideographic', 'decimal',        'decimal-leading-zero', 'disc',
		'georgian',       'hebrew',      'hiragana',        'hiragana-iroha', 'inherit',              'katakana',
		'katakana-iroha', 'lower-alpha', 'lower-greek',     'lower-latin',    'lower-roman',          'none',
		'square',         'upper-alpha', 'upper-latin',     'upper-roman'
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
		'border-color'  => array('border-top-color', 'border-right-color', 'border-bottom-color', 'border-left-color'),
		'border-style'  => array('border-top-style', 'border-right-style', 'border-bottom-style', 'border-left-style'),
		'border-width'  => array('border-top-width', 'border-right-width', 'border-bottom-width', 'border-left-width'),
		'border'        => array('border-top',       'border-right',       'border-bottom',       'border-left'),
		'margin'        => array('margin-top',       'margin-right',       'margin-bottom',       'margin-left'),
		'padding'       => array('padding-top',      'padding-right',      'padding-bottom',      'padding-left'),
		'border-radius' => 0
	),
	$fontWeight = array('normal', 'bold', 'bolder', 'lighter', '100', '200', '300', '400', '500', '600', '700', '800', '900', 'inherit'),
	$properties = array(
		'background',
		'background-color',
		'background-image',
		'background-repeat',
		'background-attachment',
		'background-position',
		'border',
		'border-top',
		'border-right',
		'border-bottom',
		'border-left',
		'border-color',
		'border-top-color',
		'border-bottom-color',
		'border-left-color',
		'border-right-color',
		'border-style',
		'border-top-style',
		'border-right-style',
		'border-left-style',
		'border-bottom-style',
		'border-width',
		'border-top-width',
		'border-right-width',
		'border-left-width',
		'border-bottom-width',
		'border-collapse',
		'border-spacing',
		'bottom',
		'caption-side',
		'content',
		'clear',
		'clip',
		'color',
		'counter-reset',
		'counter-increment',
		'cursor',
		'empty-cells',
		'display',
		'direction',
		'float',
		'font',
		'font-family',
		'font-style',
		'font-variant',
		'font-weight',
		'font-stretch',
		'font-size-adjust',
		'font-size',
		'height',
		'left',
		'line-height',
		'list-style',
		'list-style-type',
		'list-style-image',
		'list-style-position',
		'margin',
		'margin-top',
		'margin-right',
		'margin-bottom',
		'margin-left',
		'marks',
		'marker-offset',
		'max-height',
		'max-width',
		'min-height',
		'min-width',
		'overflow',
		'orphans',
		'outline',
		'outline-width',
		'outline-style',
		'outline-color',
		'padding',
		'padding-top',
		'padding-right',
		'padding-bottom',
		'padding-left',
		'page-break-before',
		'page-break-after',
		'page-break-inside',
		'page',
		'position',
		'quotes',
		'right',
		'size',
		'speak-header',
		'table-layout',
		'top',
		'text-indent',
		'text-align',
		'text-decoration',
		'text-shadow',
		'letter-spacing',
		'word-spacing',
		'text-transform',
		'white-space',
		'unicode-bidi',
		'vertical-align',
		'visibility',
		'width',
		'widows',
		'z-index',
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
		'speak-numeral',
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

	function squeeze($css, $singleLine = true, $sort = true, $indent = '', $shorthand = true)
	{
		$f = preg_replace('/[\n]+/', '', $css);

		$sort      && $f = $this->sorter($f);
		$shorthand && $f = $this->shortand($f);
		$f = $this->compress($f);
		!$singleLine && $f = $this->deflat($f, $indent);

		return $f;
	}

	protected function sorter($css)
	{
		$tree = $temp = array(); // master array to hold all values
		$elements = explode('}', $css);
		array_pop($elements);

		foreach ($elements as $element)
		{
			// get the name of the CSS element
			$name = explode('{', $element);
			$name = $name[0];

			// get all the key:value pair styles
			$styles = explode(';', $element);

			// remove element name from first property element
			$styles[0] = str_replace($name . '{', '', $styles[0]);

			// loop through each style and split apart the key from the value
			$count = count($styles);
			for ($a = 0; $a < $count; $a++)
			{
				if ('' !== $styles[$a])
				{
					$key_value = explode(':', $styles[$a]);

					// build the master css tree
					if (isset($key_value[1]))
					{
					    $key   = trim(strtolower($key_value[0]));
					    $value = trim($key_value[1]);

					    if (isset($this->color_values[$key]))
					    {
					        $value = $this->cut_color($value);
					    }
					    $tree[$name][$key] = $value;
					}
				}
			}

			// Keep only specified and valid properties
            if (isset($tree[$name]) && is_array($tree[$name]))
            {
                $temp[$name] = array_intersect_key($this->properties, $tree[$name]);
                foreach ($temp[$name] as $key => $value)
                {
                    $temp[$name][$key] = $tree[$name][$key];
                }
				
            }
		}

		$a = array();
		// Merge selectors with same styles
		foreach ($temp as $key => $value)
		{
			$a[$key] = '';
			foreach ($value as $k => $v)
			{
				$a[$key] .= $k .':' . $v . ';';
			}
		}
		$a = $this->array_unique_key_group($a);

		$s = '';
		foreach ($a as $k => $v)
		{
			$s .= $k .'{' . $v . '}';
		}
		unset($temp, $count, $name, $styles, $a, $key, $value, $k, $v);

		return $s;
	}

	// from 0cool.f > http://php.net/manual/fr/function.array-unique.php#104102
	protected function array_unique_key_group($array)
	{
		if(!is_array($array))
		return false;

		$temp = array_unique($array);
		foreach($array as $key => $val)
		{
			$i = array_search($val,$temp);
			if(!empty($i) && $key != $i)
			{
				$temp[$i.','.$key] = $temp[$i];
				unset($temp[$i]);
			}
		}

		return $temp;
	}

	protected function cut_color($color)
	{
		$color = strtolower($color);

		// rgb(0,0,0) -> #000000 (or #000 in this case later)
		if ('rgb(' == substr($color,0,4))
		{
			$color_tmp = substr($color,4,strlen($color)-5);
			$color_tmp = explode(',',$color_tmp);
			for ( $i = 0; $i < count($color_tmp); $i++ )
			{
				$color_tmp[$i] = trim ($color_tmp[$i]);
				if(substr($color_tmp[$i],-1) == '%')
				{
					$color_tmp[$i] = round((255*$color_tmp[$i])/100);
				}
				if($color_tmp[$i]>255) $color_tmp[$i] = 255;
			}
			$color = '#';
			for ($i = 0; $i < 3; $i++ )
			{
				if($color_tmp[$i]<16) {
					$color .= '0' . dechex($color_tmp[$i]);
				} else {
					$color .= dechex($color_tmp[$i]);
				}
			}
		}

		// Fix bad color names
		if (isset($this->replace_colors[$color]))
		{
			$color = $this->replace_colors[$color];
		}

		// #aabbcc -> #abc
		if (7 == strlen($color))
		{
			$color_temp = strtolower($color);
			if ('#' == $color_temp{0} && $color_temp{1} == $color_temp{2} && $color_temp{3} == $color_temp{4} && $color_temp{5} == $color_temp{6})
			{
				$color = strtoupper('#'.$color{1}.$color{3}.$color{5});
			}
		}
		elseif (4 == strlen($color)) $color = strtoupper($color);

		switch($color)
		{
			/* color name -> hex code */
			case 'black'  : return '#000';
			case 'fuchsia': return '#F0F';
			case 'white'  : return '#FFF';
			case 'yellow' : return '#FF0';

			/* hex code -> color name */
			case '#800000': return 'maroon';
			case '#ffa500': return 'orange';
			case '#808000': return 'olive';
			case '#800080': return 'purple';
			case '#008000': return 'green';
			case '#000080': return 'navy';
			case '#008080': return 'teal';
			case '#c0c0c0': return 'silver';
			case '#808080': return 'gray';
			case '#C00'   : return 'red';
		}

		return $color;
	}

	protected function shortand($f)
	{
		$p = $r = array();
		$units      = implode('|', $this->units     );
		$fontSize   = implode('|', $this->fontSize  );
		$fontStyle  = implode('|', $this->fontStyle );
		$fontWeight = implode('|', $this->fontWeight);

		$property  = '((' . implode('|', array_keys($this->shorthands)) .')(\s)*:(\s)*)';
		$numeric   = '-?([0-9]+|([0-9]*\.[0-9]+))';
		$important = '(\s*!important\s*)?';
		$parameter = "({$numeric}({$units})|auto|inherit)";

		// shorthand properties
		// font: 1em/1.5em bold italic serif
		$p[] = "/(font-family):([ -_ a-zA-Z0-9]+);(font-style):({$fontStyle});(font-weight):({$fontWeight});(font-size):([.0-9]+)({$units});(line-height):({$numeric})({$units});/";
		$r[] = 'font:$8$9/$13$14 $6 $4 $2;';

		// background: #fff url(image.gif) no-repeat top left
		$p[] = '/(background-color):([#a-zA-Z]+);(background-image):(url\([-_a-zA-Z0-9]+.[a-zA-Z]+\));(background-repeat):(repeat|no-repeat|repeat-x|repeat-y|inherit);(background-position):(top|right|bottom|left|center)(\s+)?(top|right|bottom|left|center);/';
		$r[] = 'background:$2 $4 $6 $8 $10;';

		foreach ($this->shorthands as $k => $v)
		{
			// (margin|padding|border): 2px 1px 3px 4px (top, right, bottom, left)
			$p[] = "/({$k}-top):(({$numeric})({$units}));({$k}-right):(({$numeric})({$units}));({$k}-bottom):(({$numeric})({$units}));({$k}-left):(({$numeric})({$units}));/";
			$r[] = "{$k}:$2 $8 $14 $20;";

		}

		//  list-style: disc outside url(image.gif)
        $position = implode('|', $this->listeStyleType);
		$p[] = "/(liste-style):([#a-zA-Z]+);(liste-style-type):({$position});(liste-style-image):(url\([-_a-zA-Z0-9]+.[a-zA-Z]+\)|none|inherit);(liste-style-position):(inside|outside|inherit);/";
		$r[] = 'liste-style:$2 $4 $7 $9;';

		// 1px 1px 1px 1px => 1px
		$p[] = "#{$property}({$parameter})" . '\s\5\s\5\s\5' . "{$important};#";
		$r[] = '$1$5$10;';
		// 1px 2px 1px 2px => 1px 2px
		$p[] ="#{$property}({$parameter}\s)({$parameter})" . '\s\5\10' . "{$important};#";
		$r[] = '$1$5$10$15;';
		// 1px 2px 3px 2px => 1px 2px 3px
		$p[] = "#{$property}({$parameter}\s)({$parameter})\s({$parameter})" . '\s\10' . "{$important};#";
		$r[] = '$1$5$10 $15$20;';

		return preg_replace($p, $r, $f);
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
