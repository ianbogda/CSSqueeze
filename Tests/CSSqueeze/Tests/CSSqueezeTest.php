<?php

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

    public function testCSSqueezesDeflat()
    {
        $xfail= 0;
        $files = array(
            'deflat.css',
            'deflatComments.css',
        );

        foreach($files as $file)
        {
            $test = file_get_contents(__DIR__ . '/test/' . $file);
            $expe = file_get_contents(__DIR__ . '/expected/' . $file);

            $cz = new CSSqueeze('    ');
            $test = $cz->squeeze($test, false) . "\n";

            $xfail
                ? $this->assertFalse($expe === $test, "Xfail {$file}")
                : $this->assertSame($expe, $test, "TestingXfail {$file}");
        }
    }

    public function testCSSqueezesImport()
    {
        $xfail= 0;
        $files = array(
            'import.css',
        );

        foreach($files as $file)
        {
            $configuration = array('BasePath' => __DIR__ . '/test/');
            $expe = file_get_contents(__DIR__ . '/expected/' . $file);

            $cz = new CSSqueeze('', $configuration);
			$test = $cz->squeeze($file) . "\n";

            $xfail
                ? $this->assertFalse($expe === $test, "Xfail {$file}")
                : $this->assertSame($expe, $test, "TestingXfail {$file}");
        }
    }

    public function testCSSqueezesMedia()
    {
        $xfail= 0;
        $files = array(
            'media.css',
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
