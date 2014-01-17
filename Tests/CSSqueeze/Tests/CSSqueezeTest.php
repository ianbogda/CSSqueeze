<?php
namespace Patchwork;
use Patchwork;

class CSSqueezeTest extends \PHPUnit_Framework_TestCase
{
    public function testCSSqueezeRemove()
    {
        $xfail= 0;
        $files = array(
            'comment.css',
            'emptyStatment.css',
            'whitespace.css',
        );

        foreach($files as $file)
        {
            $test = file_get_contents(__DIR__ . '/test/' . $file);
            $expe = file_get_contents(__DIR__ . '/expected/' . $file);

            $cz = new CSSqueeze;
            $test = $cz->squeeze($test) . "\n";

            $xfail
                ? $this->assertFalse($expe === $test, "Xfail {$file}")
                : $this->assertSame($expe, $test, "TestingXfail {$file}");
        }
    }

    public function testCSSqueezeColors()
    {
        $xfail= 0;
        $files = array(
            'cutColors.css',
            'reduceColors.css',
        );

        foreach($files as $file)
        {
            $test = file_get_contents(__DIR__ . '/test/' . $file);
            $expe = file_get_contents(__DIR__ . '/expected/' . $file);

            $cz = new CSSqueeze;
            $test = $cz->squeeze($test) . "\n";

            $xfail
                ? $this->assertFalse($expe === $test, "Xfail {$file}")
                : $this->assertSame($expe, $test, "TestingXfail {$file}");
        }
    }

    public function testCSSqueezeHacks()
    {
        $xfail= 0;
        $files = array(
            'ie6hack.css',
            'ie7hack.css',
            'operahack.css',
        );

        foreach($files as $file)
        {
            $test = file_get_contents(__DIR__ . '/test/' . $file);
            $expe = file_get_contents(__DIR__ . '/expected/' . $file);

            $cz = new CSSqueeze;
            $test = $cz->squeeze($test) . "\n";

            $xfail
                ? $this->assertFalse($expe === $test, "Xfail {$file}")
                : $this->assertSame($expe, $test, "TestingXfail {$file}");
        }
    }

    public function testCSSqueezesReduce()
    {
        $xfail= 0;
        $files = array(
            'mergeSameSelectors.css',
            'mergeselectors.css',
            'shorthand.css',
        );

        foreach($files as $file)
        {
            $test = file_get_contents(__DIR__ . '/test/' . $file);
            $expe = file_get_contents(__DIR__ . '/expected/' . $file);

            $cz = new CSSqueeze;
            $test = $cz->squeeze($test) . "\n";

            $xfail
                ? $this->assertFalse($expe === $test, "Xfail {$file}")
                : $this->assertSame($expe, $test, "TestingXfail {$file}");
        }
    }
}
