<?php
namespace Poppler\Tests\Driver;

use Alchemy\BinaryDriver\Configuration;
use Poppler\Driver\Pdftohtml;
use Poppler\Tests\TestCase;
use Symfony\Component\Process\ExecutableFinder;

class PdftohtmlTest extends TestCase
{
    public function setUp()
    {
        $executableFinder = new ExecutableFinder();
        $found = false;
        foreach (array('pdftohtml') as $name) {
            if (null !== $executableFinder->find($name)) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $this->markTestSkipped('pdftohtml not found');
        }
    }

    public function testCreate()
    {
        $logger = $this->createLoggerMock();
        $pdftohtml = Pdftohtml::create($logger, array());
        $this->assertInstanceOf('Poppler\Driver\Pdftohtml', $pdftohtml);
        $this->assertEquals($logger, $pdftohtml->getProcessRunner()->getLogger());
    }

    public function testCreateWithConfig()
    {
        $conf = new Configuration();
        $pdftohtml = Pdftohtml::create($this->createLoggerMock(), $conf);
        $this->assertEquals($conf, $pdftohtml->getConfiguration());
    }

    /**
     * @expectedException \Poppler\Exception\ExecutableNotFoundException
     */
    public function testCreateFailureThrowsAnException()
    {
        Pdftohtml::create($this->createLoggerMock(), array('pdftohtml.binaries' => '/path/to/nowhere'));
    }
}