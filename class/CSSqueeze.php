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
namespace Patchwork;

use Patchwork;

class CSSqueeze
{
    /** @var boolean $keepHack keep /or not css hacks */
    protected $keepHack = true;

    /** @var array[] $units array css units */
    protected $units = array('in', 'cm',  'mm', 'pt','pc','px', 'rem',
                             'em', '%',   'ex', 'gd','vw','vh', 'vm',
                             'deg','grad','rad','ms','s', 'khz','hz'
    );

    /** @var array[] $prop_values array of css properties values */
    protected $prop_values = array(
        'background',       'background-position', 'background-size',
        'border',           'border-top',          'border-right',      'border-bottom',       'border-left', 'border-width',
        'border-top-width', 'border-right-width',  'border-left-width', 'border-bottom-width', 'bottom',      'border-spacing',
        'column-gap',       'column-width',        'font-size',         'height',              'left',        'margin',
        'margin-top',       'margin-right',        'margin-bottom',     'margin-left',         'max-height',  'max-width',
        'min-height',       'min-width',           'outline',           'outline-width',       'padding',     'padding-top',
        'padding-right',    'padding-bottom',      'padding-left',      'perspective',         'right',       'top',
        'text-indent',      'letter-spacing',      'word-spacing',      'width',
    );

    /** @var array[] $fontSize array of css fontsize */
    protected $fontSize  = array('xx-small', 'x-small',  'small',   'medium', 'large',
                                 'x-large',  'xx-large', 'smaller', 'larger', 'inherit'
    );

    /** @var array[] $fontStyle array of css font style */
    protected $fontStyle = array('normal', 'italic', 'oblique', 'inherit');

    /** @var array[] $colorValues array of css color values */
    protected $colorValues = array(
        'background-color', 'border-color', 'border-top-color', 'border-right-color', 'border-bottom-color',
        'border-left-color', 'color',       'outline-color',    'column-rule-color',
    );

    /** @var array[] $listeStyleType array of css liste style type */
    protected $listeStyleType = array(
        'armenian',       'circle',      'cjk-ideographic', 'decimal',        'decimal-leading-zero', 'disc',
        'georgian',       'hebrew',      'hiragana',        'hiragana-iroha', 'inherit',              'katakana',
        'katakana-iroha', 'lower-alpha', 'lower-greek',     'lower-latin',    'lower-roman',          'none',
        'square',         'upper-alpha', 'upper-latin',     'upper-roman',
    );

    /** @var array[] $replaceColors array of css replace naming to hexa colors */
    protected $replaceColors =  array(
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
    );

    /** @var array[] $shortColor array of css shorthands */
    protected $shorthands = array(
        'border-color'  => array('border-top-color', 'border-right-color', 'border-bottom-color', 'border-left-color',),
        'border-style'  => array('border-top-style', 'border-right-style', 'border-bottom-style', 'border-left-style',),
        'border-width'  => array('border-top-width', 'border-right-width', 'border-bottom-width', 'border-left-width',),
        'border'        => array('border-top',       'border-right',       'border-bottom',       'border-left',),
        'margin'        => array('margin-top',       'margin-right',       'margin-bottom',       'margin-left',),
        'padding'       => array('padding-top',      'padding-right',      'padding-bottom',      'padding-left',),
        'border-radius' => 0
    );

    /** @var array[] $shortColor array of css font weight */
    protected $fontWeight = array('normal', 'bold', 'bolder', 'lighter', '100', '200', '300',
                                  '400',    '500',   '600', '  700',     '800', '900', 'inherit'
    );

    /** @var array[] $shortColor array of css properties */
    protected $properties = array(
        'position', 'top', 'right', 'bottom', 'left', 'z-index', 'display', 'visibility',
        '-webkit-flex-direction', '-webkit-flex-order', '-webkit-flex-pack', '-webkit-flex-align',
           '-moz-flex-direction',    '-moz-flex-order',    '-moz-flex-pack',    '-moz-flex-align',
            '-ms-flex-direction',     '-ms-flex-order',     '-ms-flex-pack',     '-ms-flex-align',
             '-o-flex-direction',      '-o-flex-order',      '-o-flex-pack',      '-o-flex-align',
                'flex-direction',         'flex-order',         'flex-pack',         'flex-align',
        'float', 'clear', 'overflow',  '-ms-overflow-x',  '-ms-overflow-y', 'overflow-x', 'overflow-y',
        'clip',  '-webkit-box-sizing', '-moz-box-sizing', 'box-sizing',
        'margin',        'margin-top',          'margin-right',        'margin-bottom',  'margin-left',
        'padding',       'padding-top',         'padding-right',       'padding-bottom', 'padding-left',
        'min-width',     'min-height',          'max-width',           'max-height',     'width',          'height',
        'outline',       'outline-width',       'outline-style',       'outline-color',  'outline-offset',
        'border',        'border-spacing',      'border-collapse',     'border-width',   'border-style',  'border-color',
        'border-top',    'border-top-width',    'border-top-style',    'border-top-color',
        'border-right',  'border-right-width',  'border-right-style',  'border-right-color',
        'border-bottom', 'border-bottom-width', 'border-bottom-style', 'border-bottom-color',
        'border-left',   'border-left-width',   'border-left-style',   'border-left-color',
        '-webkit-border-radius', '-webkit-border-top-left-radius', '-webkit-border-top-right-radius',
           '-moz-border-radius',     '-moz-border-radius-topleft',     '-moz-border-radius-topright',
                'border-radius',         'border-top-left-radius',         'border-top-right-radius',
        '-webkit-border-bottom-right-radius', '-webkit-border-bottom-left-radius', '-webkit-border-image',
            '-moz-border-radius-bottomright',     '-moz-border-radius-bottomleft',    '-moz-border-image',
                'border-bottom-right-radius',         'border-bottom-left-radius',      '-o-border-image',
        '-webkit-border-image-source', '-webkit-border-image-slice', '-webkit-border-image-width',
           '-moz-border-image-source',    '-moz-border-image-slice',    '-moz-border-image-width',
             '-o-border-image-source',      '-o-border-image-slice',      '-o-border-image-width',
                'border-image-source',         'border-image-slice',         'border-image-width',
        '-webkit-border-image-outset', '-webkit-border-image-repeat', '-webkit-border-top-image',
           '-moz-border-image-outset',    '-moz-border-image-repeat',    '-moz-border-top-image',
             '-o-border-image-outset',      '-o-border-image-repeat',      '-o-border-top-image',
                'border-image-outset',         'border-image-repeat',         'border-top-image',
        '-webkit-border-right-image', '-webkit-border-bottom-image', '-webkit-border-left-image',
           '-moz-border-right-image',    '-moz-border-bottom-image',    '-moz-border-left-image',
             '-o-border-right-image',      '-o-border-bottom-image',      '-o-border-left-image',
                'border-right-image',         'border-bottom-image',         'border-left-image',
        '-webkit-border-corner-image', '-webkit-border-top-left-image', '-webkit-border-top-right-image',
           '-moz-border-corner-image',    '-moz-border-top-left-image',    '-moz-border-top-right-image',
             '-o-border-corner-image',      '-o-border-top-left-image',      '-o-border-top-right-image',
                'border-corner-image',         'border-top-left-image',         'border-top-right-image',
        '-webkit-border-bottom-right-image', '-webkit-border-bottom-left-image',
           '-moz-border-bottom-right-image',    '-moz-border-bottom-left-image',
             '-o-border-bottom-right-image',      '-o-border-bottom-left-image',
                'border-bottom-right-image',         'border-bottom-left-image',
        'background',       'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader',
        'background-color', 'background-image', 'background-attachment', 'background-position',
        '-ms-background-position-x', '-ms-background-position-y', 'background-position-x', 'background-position-y',
        'background-clip', 'background-origin', 'background-size', 'background-repeat', 'box-decoration-break',
        '-webkit-box-shadow', '-moz-box-shadow', 'box-shadow', 'color', 'table-layout', 'caption-side',
        'empty-cells', 'list-style', 'list-style-position', 'list-style-type', 'list-style-image', 'quotes',
        'content', 'counter-increment', 'counter-reset', '-ms-writing-mode', 'vertical-align', 'text-align',
        '-webkit-text-align-last', '-moz-text-align-last', '-ms-text-align-last', 'text-align-last',
        'text-decoration', 'text-emphasis', 'text-emphasis-position', 'text-emphasis-style', 'text-emphasis-color',
        'text-indent', '-ms-text-justify', 'text-justify', 'text-outline', 'text-transform', 'text-wrap',
        '-ms-text-overflow', 'text-overflow', 'text-overflow-ellipsis', 'text-overflow-mode', 'text-shadow',
        'white-space', 'word-spacing', '-ms-word-wrap', 'word-wrap', '-ms-word-break', 'word-break', '-moz-tab-size',
        '-o-tab-size', 'tab-size', '-webkit-hyphens', '-moz-hyphens', 'hyphens', 'letter-spacing',
        'font', 'font-weight', 'font-style', 'font-variant', 'font-size-adjust', 'font-stretch', 'font-size', 'font-family',
        'src', 'line-height', 'opacity', '-ms-filter:\'progid:DXImageTransform.Microsoft.Alpha',
        'filter:progid:DXImageTransform.Microsoft.Alpha(Opacity', '-ms-interpolation-mode', '-webkit-filter', '-ms-filter',
        'filter', 'resize', 'cursor', 'nav-index', 'nav-up', 'nav-right', 'nav-down', 'nav-left',
        '-webkit-transition', '-webkit-transition-delay', '-webkit-transition-timing-function', 
           '-moz-transition',    '-moz-transition-delay',    '-moz-transition-timing-function',
            '-ms-transition',     '-ms-transition-delay',     '-ms-transition-timing-function',
             '-o-transition',      '-o-transition-delay',      '-o-transition-timing-function',
                'transition',         'transition-delay',         'transition-timing-function',
        '-webkit-transition-duration',   '-webkit-transition-property',
           '-moz-transition-duration',      '-moz-transition-property',
            '-ms-transition-duration',       '-ms-transition-property',  
             '-o-transition-duration',        '-o-transition-property',
                'transition-duration',           'transition-property',
        '-webkit-transform','-webkit-transform-origin', '-webkit-animation', '-webkit-animation-name',
           '-moz-transform',   '-moz-transform-origin',    '-moz-animation',    '-moz-animation-name',
            '-ms-transform',    '-ms-transform-origin',     '-ms-animation',     '-ms-animation-name',
             '-o-transform',     '-o-transform-origin',      '-o-animation',      '-o-animation-name',
                'transform',        'transform-origin',         'animation',         'animation-name',
        '-webkit-animation-duration', '-webkit-animation-play-state', '-webkit-animation-timing-function',
           '-moz-animation-duration',    '-moz-animation-play-state',    '-moz-animation-timing-function',
            '-ms-animation-duration',     '-ms-animation-play-state',     '-ms-animation-timing-function',
             '-o-animation-duration',      '-o-animation-play-state',      '-o-animation-timing-function',
                'animation-duration',         'animation-play-state',         'animation-timing-function',
        '-webkit-animation-delay', '-webkit-animation-iteration-count', '-webkit-animation-direction',
           '-moz-animation-delay',    '-moz-animation-iteration-count',    '-moz-animation-direction',
            '-ms-animation-delay',     '-ms-animation-iteration-count',     '-ms-animation-direction',
             '-o-animation-delay',      '-o-animation-iteration-count',      '-o-animation-direction',
                'animation-delay',         'animation-iteration-count',         'animation-direction',
        'pointer-events', 'unicode-bidi', 'direction',
        '-webkit-columns', '-webkit-column-span', '-webkit-column-width', '-webkit-column-count',
           '-moz-columns',    '-moz-column-span',    '-moz-column-width',    '-moz-column-count',
                'columns',         'column-span',         'column-width',         'column-count',
        '-webkit-column-fill', '-webkit-column-gap', '-webkit-column-rule', '-webkit-column-rule-width',
           '-moz-column-fill',    '-moz-column-gap',    '-moz-column-rule',    '-moz-column-rule-width',
                'column-fill',         'column-gap',         'column-rule',         'column-rule-width',
        '-webkit-column-rule-style', '-webkit-column-rule-color',
           '-moz-column-rule-style',    '-moz-column-rule-color',
                'column-rule-style',         'column-rule-color',
        'break-before', 'break-inside', 'break-after', 'page-break-before', 'page-break-inside',     'page-break-after',
        'orphans',      'windows',      '-ms-zoom',    'zoom', 'max-zoom',  'min-zoom', 'user-zoom', 'orientation',
/* Speech */
        'volume',  'speak',      'pause',       'pause-before', 'pause-after', 'speak-punctuation', 'speak-numeral',
        'cue',     'cue-before', 'cue-after',   'play-during',  'stress',      'richness',
        'azimuth', 'elevation',  'speech-rate', 'voice-family', 'pitch',       'pitch-range', 
        
    );

    /** @var array[] $shortColor array of short colors */
    protected $shortColor = array(
        /* color name -> hex code */
        'black'  => '#000',
        'fuchsia'=> '#f0f',
        'white'  => '#fff',
        'yellow' => '#ff0',

        /* hex code -> color name */
        '#800000'=> 'maroon',
        '#ffa500'=> 'orange',
        '#808000'=> 'olive',
        '#800080'=> 'purple',
        '#008000'=> 'green',
        '#000080'=> 'navy',
        '#008080'=> 'teal',
        '#c0c0c0'=> 'silver',
        '#808080'=> 'gray',
        '#c00'   => 'red',
    );

    public function __construct()
    {
        $this->properties  = array_flip($this->properties );
        $this->prop_values = array_flip($this->prop_values);
        $this->colorValues = array_flip($this->colorValues);
    }

    /**
    * Squeezes a Cascade Style Sheet source code.
    *
    * @param string  $css        css to consume.
    * @param bool    $singleLine compress /or not css.
    * @param bool    $keepHack   keep /or not css hacks.
    *
    * @return string Returns the final css.
    */
    public function squeeze($css, $singleLine = true, $keepHack = true)
    {
        $css = trim($css);
        if ('' === $css) return '';

        $this->keepHack = $keepHack;
        $css = $this->prepareComments($css);

        list($selectors, $blocks) = $this->tokenize($css);

        // Merge selectors //
        list($s, $b) = $this->mergeSelectors($selectors, $blocks);
        $_css_ = $this->uniqueArray($s, $b);

        // Which one ?
        $_css = $this->uniqueArray($selectors, $blocks);
        $f = strlen($_css_) > strlen($_css) ? $_css : $_css_;

        $cssDeflat = $this->deflat($f);
        return $singleLine ? $f : $cssDeflat;
    }

    /**
    * Merge selectors.
    *
    * @param array[] $selectors Array of css selectors.
    * @param array[] $blocks    Array of css blocks.  .
    *
    * @return array[] Returns array of $slectors and $blocks.
    */
    protected function mergeSelectors($selectors, $blocks)
    {
        // merge same selectors //
        $b = array();
        $a = array_count_values($selectors);

        foreach ($a as $k => $v)
        {
            reset($selectors);
            while (list($k2, $v2) = each($selectors))
            {
                if ($v2 != $k) continue;
                switch (true)
                {
                case (isset($b[$k]))       : $b[$k] .= $blocks[$k2]; break;
                case (isset($blocks[$k2])) : $b[$k]  = $blocks[$k2]; break;
                }
            }
        }

        $selectors = array_keys($b);
        $self = $this;
        $blocks    = array_map(function($value) use($self)
           {return $self->sorter($value); }, array_values($b));

        return array($selectors, $blocks);
    }

    /**
    * unique array (remove duplicates).
    *
    * @param array[] $selectors Array of css selectors.
    * @param array[] $blocks    Array of css blocks.  .
    *
    * @return array[] Returns array of $slectors and $blocks.
    */
    protected function uniqueArray($selectors, $blocks)
    {
        // Prepare to have unique array
        $a = array();
        $tokens = count($selectors);
        for ($i = 0; $i < $tokens; ++$i)
        {
            isset($blocks[$i]) && $a[$selectors[$i]] = $blocks[$i];
        }

        // from 0cool.f > http://php.net/manual/fr/function.array-unique.php#104102
        $temp = array_unique($a);
        reset ($a);
        while (list($key, $value) = each($a))
        {
            $i = array_search($value, $temp);
            if (!empty($i) && $key != $i)
            {
                $temp[$i.','.$key] = $temp[$i];
                unset($temp[$i]);
            }
        }
        //--> end 0ccol.f tricks

        $f = implode( array_map( function ($key, $value)
        { return sprintf("%s{%s}", $value, $key); }, $temp, array_keys($temp)));

        unset($temp);

        return $this->compress($f);
    }

    /**
    * Prepare comments.
    *
    * @param string $css full css.
    *
    * @return string Returns css uncommented.
    */
    protected function prepareComments($css)
    {
        // from http://minify.googlecode.com/svn/trunk/min/lib/Minify/CSS/Compressor.php
        $pattern = $replacement = array();

        if ($this->keepHack)
        {
            // preserve empty comment after '>'
            // http://www.webdevout.net/css-hacks#in_css-selectors
            $pattern[]     = '@>/\\*\\s*\\*/@';
            $replacement[] = '>/*keep*/';

            // preserve empty comment between property and value
            // http://css-discuss.incutio.com/?page=BoxModelHack
            $pattern[]     = '@/\\*\\s*\\*/\\s*:@';
            $replacement[] = '/*keep*/:';

            $pattern[]     = '@:\\s*/\\*\\s*\\*/@';
            $replacement[] = ':/*keep*/';

            // prevent triggering IE6 bug: http://www.crankygeek.com/ie6pebug/
            $pattern[]     = '/:first-l(etter|ine)\\{/';
            $replacement[] = ':first-l$1 {';
        }

        /* remove comments but keep importants one */
        $pattern[]     = '#\/\*[^\!].*\*\/#isU';
        $replacement[] = '';

        return preg_replace($pattern, $replacement, $css);
    }

    /**
    * Tokenize Cascade Style Sheet source code.
    *
    * @param string  $lines      css to consume.
    * @param bool    $singleLine compress /or not css.
    * @param bool    $keepHack   keep /or not css hacks.
    *
    * @return string Returns the final css.
    */
    protected function tokenize($lines)
    {
        $rules = $selectors = $blocks = array();
        $pos = $spos = $bpos = 0;

        $token = strtok((string)$lines, "{}");

        while (false !== $token)
        {
             $rules[$pos] = $token;
            ++$pos;
            $token = strtok('{}');
        }

        $size = count($rules);

        for ($i = 0; $i < $size; ++$i)
        {
            if (0 == $i % 2)
            {
                $selectors[$spos] = "\n" . trim($rules[$i]);
                ++$spos;
            }
            else
            {
                $blocks[$bpos] = $this->sorter($rules[$i]);
                ++$bpos;
            }
        }
        unset($token, $rules, $size, $pos, $spos, $bpos);

        return array($selectors, $blocks);
    }

    /**
    * Sorter blocks
    *
    * @param array[] $block      css to consume.
    *
    * @return array[] Returns block sorted.
    */
    public function sorter($block)
    {
        $a = array(); // master array to hold all values

        $declarations = explode(';', $block);

        // loop through each style and split apart the key from the value
        foreach($declarations as $declaration)
        {
            $propertyValue = explode(':', $declaration);

            if (!isset($propertyValue[1])) continue;

            $property = trim(strtolower($propertyValue[0]));
            $value    = trim($propertyValue[1]);

            $a[$property] = (isset($this->colorValues[$property]))
                ? $this->getShortestColor($value)
                : $value;
        }

        // Keep only specified and valid properties (this remove ie hacks)
        $b = array_intersect_key($this->properties, $a);

        foreach ($b as $key => $value)
        {
            $b[$key] = $a[$key];
        }

        $block = implode( array_map( function ($key, $value)
            { return sprintf("%s:%s;", $value, $key); }, $b, array_keys($b)));

        unset($a, $b);

        return $block;
    }

    /**
    * Get short color value
    *
    * @param string $color color to short.
    *
    * @return string Returns shortest color.
    */
    protected function getShortestColor($color)
    {
        // rgb(0,0,0) -> #000000 (or #000 in this case later)
        $color = strtolower($color);

        // rgb color
        if (false !== strpos($color, "rgb("))
        {
            $rgb = str_replace('rgb(','', $color);
            $rgb = str_replace(')','', $rgb);

            if (false !== strpos($rgb, '%'))
            {
                $rgb = str_replace('%','', $rgb);
                $rgb = explode(',', $rgb);

                $hex  = sprintf('%02x', round(255 * $rgb[0] / 100,0));
                $hex .= sprintf('%02x', round(255 * $rgb[1] / 100,0));
                $hex .= sprintf('%02x', round(255 * $rgb[2] / 100,0));
            }
            else
            {
                $rgb = explode(',', $rgb);

                $hex  = str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
                $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
                $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);
            }
            $color = '#' . $hex;
        }

        // Fix bad color names
        (isset($this->replaceColors[$color])) && $color = $this->replaceColors[$color];

         // #aabbcc -> #abc
         $pattern     = '/#([a-f\\d])\\1([a-f\\d])\\2([a-f\\d])\\3/';
         $replacement = '#$1$2$3';
         $color       = preg_replace($pattern, $replacement, $color);

         unset($pattern, $replacement);

         /* return shortest color name or hexa code */
         return (isset($this->shortColor[$color]))
             ? $this->shortColor[$color]
             : $color;
    }

    /**
    * Compress css
    *
    * @param string $css css to consume.
    *
    * @return string Returns css compressed.
    */
    protected function compress($css)
    {
        $css = $this->shortand($css);
        $pattern = $replacement = array();

        $units = implode('|', $this->units);

        // minimize hex colors
        $pattern[]     = '/([^=])#([a-f\\d])\\2([a-f\\d])\\3([a-f\\d])\\4([\\s;\\}])/i';
        $replacement[] = '$1#$2$3$4$5';

        /* 0.1em => .1em */
        $pattern[]     = "#(-?)0\.(\d+({$units}))#";
        $replacement[] = '$1.$2';

        /* 0px => 0 */
        $pattern[]     = "#([\s]|:)0({$units})#";
        $replacement[] = '${1}0';

        /* 0 0 0 0 | 0 0 0 | 0 0 => 0 */
        $pattern[]     = "#:0 0 0 0;#";
        $replacement[] = ':0;';
        $pattern[]     = "#:0 0 0;#";
        $replacement[] = ':0;';
        $pattern[]     = "#:0 0;#";
        $replacement[] = ':0;';

        /* Removing unnecessary decimal*/
        $pattern[]     = "#:(([^;]*-?[0-9]*)\.|([^;]*-?[0-9]*\.[1-9]+))0+({$units})([^;]*);#";
        $replacement[] = ':$2$3$4$5;';

        /* remove empty selectors */
        $pattern[]     = '#([^}]+){}#isU';
        $replacement[] = '';

        /* remove tabs, spaces, newlines, etc. */
        $pattern[]     = '`\A[ \t]*\r?\n|\r?\n[ \t]*\Z`';
        $replacement[] = '';
        $pattern[]     = '/^\/\*(\r\n|\r|\n|\t|\s\s+)/';
        $replacement[] = '';
        $pattern[]     = '/(\*\/)\r?\n?/';
        $replacement[] = '$1';

        // Fix url()
        $pattern[]     = '#(url|rgba|rgb|hsl|hsla|attr)\((.*)\)(\S)#isU';
        $replacement[] = '$1($2) $3';

        /* remove whitespace around operators */
        $pattern[]     = '/(?<=[\[\(>+=]|=[=~^$*|>+\]\)])/';
        $replacement[] = '';

        /* remove whitespace on both sides of colons znd operators : >=[]~ */
        $pattern[]     = '/\s?(\:|\>|=|\[|\]|~)\s?/';
        $replacement[] = '$1';

        /* remove whitespace on both sides of curly brackets {} */
        $pattern[]     = '/\s?\{\s?/';
        $replacement[] = '{';
        $pattern[]     = '/\W\s?\}\W\s?/';
        $replacement[] = '}';

        /* remove whitespace on both sides of commas , */
        $pattern[]     = '/\s?\,\s?/';
        $replacement[] = ',';

        /* remove multi semi-colons */
        $pattern[]     = '/;+/';
        $replacement[] = ';';

        /* remove semi-colons before closing curly bracket } */
        $pattern[]     = '/;\}/';
        $replacement[] = '}';

        return preg_replace($pattern, $replacement, $css);
    }

    /**
    * Deflat compressed css
    *
    * @param string $css    compressed css to consume.
    * @param string $indent string indent
    *
    * @return string Returns css defalted.
    */
    protected function deflat($css, $indent = '')
    {
        $css = $this->shortand($css);
        $pattern = $replacement = array();

        /* add semicolon before curly bracket } and newline after */
        $pattern[]     = '/([}])/';
        $replacement[] = ";$1\n\n";

        /* add whitespace before curly bracket { */
        $pattern[]     = '/([{])/';
        $replacement[] = " $1\n";

        /* add newlines after semicolons ; */
        $pattern[]     = '/([;])/';
        $replacement[] = "$1\n";

        if ($indent)
        {
            $pattern[]     = '/((.*):(.*))/';
            $replacement[] = $indent . '$1';
        }

        return preg_replace($pattern, $replacement, $css);
    }

    /**
    * shorthand
    *
    * @param string $css    compressed css to consume.
    *
    * @return string Returns css defalted.
    */
    protected function shortand($css)
    {
        $pattern = $replacement = array();
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
        $pattern[]     = "/(font-family):([ -_ a-zA-Z0-9]+);(font-style):({$fontStyle});" .
                             "(font-weight):({$fontWeight});(font-size):(([.0-9]+)({$units})|({$fontSize}));" .
                             "(line-height):({$numeric})({$units});/";
        $replacement[] = 'font:$8/$13$14 $6 $4 $2;';

        // background: #fff url(image.gif) no-repeat top left
        $pattern[]     = '/(background-color):([#a-zA-Z]+);(background-image):(url\([-_a-zA-Z0-9]+.[a-zA-Z]+\));' .
                             '(background-repeat):(repeat|no-repeat|repeat-x|repeat-y|inherit);' .
                             '(background-position):(top|right|bottom|left|center)(\s+)?(top|right|bottom|left|center);/';
        $replacement[] = 'background:$2 $4 $6 $8 $10;';

        foreach ($this->shorthands as $k => $v)
        {
            // (margin|padding|border): 2px 1px 3px 4px (top, right, bottom, left)
            $pattern[]     = "/({$k}-top):(({$numeric})({$units}));({$k}-right):(({$numeric})({$units}));" .
                                 "({$k}-bottom):(({$numeric})({$units}));({$k}-left):(({$numeric})({$units}));/";
            $replacement[] = "{$k}:$2 $8 $14 $20;";

        }

        //  list-style: disc outside url(image.gif)
        $position = implode('|', $this->listeStyleType);
        $pattern[]     = "/(liste-style):([#a-zA-Z]+);(liste-style-type):({$position});" .
                             "(liste-style-image):(url\([-_a-zA-Z0-9]+.[a-zA-Z]+\)|none|inherit);" .
                             "(liste-style-position):(inside|outside|inherit);/";
        $replacement[] = 'liste-style:$2 $4 $7 $9;';

        // 1px 1px 1px 1px => 1px
        $pattern[]     = "#{$property}({$parameter})" . '\s\5\s\5\s\5' . "{$important};#";
        $replacement[] = '$1$5$10;';
        // 1px 2px 1px 2px => 1px 2px
        $pattern[]     ="#{$property}({$parameter}\s)({$parameter})" . '\s\5\10' . "{$important};#";
        $replacement[] = '$1$5$10$15;';
        // 1px 2px 3px 2px => 1px 2px 3px
        $pattern[]     = "#{$property}({$parameter}\s)({$parameter})\s({$parameter})" . '\s\10' . "{$important};#";
        $replacement[] = '$1$5$10 $15$20;';

        return preg_replace($pattern, $replacement, $css);
    }
}
