<?php
namespace Patchwork;
use Patchwork;

class CSSqueezeTest extends \PHPUnit_Framework_TestCase
{
    function testCSSqueezeCompressor()
    {
        if ($h = opendir(__DIR__ . '/test/'))
        {
            while ($file = readdir($h))
            {
                $xfail = '.xfail' === substr($file, -6) ? '.xfail' : '';
                if ($xfail) $file = substr($file, 0, -6);

                if ('.css' === substr($file, -4) && file_exists(__DIR__ . '/expected/' . $file))
                {
                    $test = file_get_contents(__DIR__ . '/test/' . $file . $xfail);
                    $expe = file_get_contents(__DIR__ . '/expected/' . $file);

                    $cz = new CSSqueeze;
                    $test = $cz->squeeze($test) . "\n";

                    $xfail
                        ? $this->assertFalse($expe === $test, "Xfail {$file}")
                        : $this->assertSame($expe, $test, "Testing {$file}");
                }
            }
        }
    }
}
