<?php
namespace Poppler\Tests\Driver;

use Alchemy\BinaryDriver\Configuration;
use Poppler\Driver\Pdftotext;
use Poppler\Tests\TestCase;
use Symfony\Component\Process\ExecutableFinder;

class PdftotextTest extends TestCase
{
    public function setUp()
    {
        $executableFinder = new ExecutableFinder();
        $found = false;
        foreach (array('pdftotext') as $name) {
            if (null !== $executableFinder->find($name)) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $this->markTestSkipped('pdftotext not found');
        }
    }

    public function testCreate()
    {
        $logger = $this->createLoggerMock();
        $pdftotext = Pdftotext::create($logger, array());
        $this->assertInstanceOf('Poppler\Driver\Pdftotext', $pdftotext);
        $this->assertEquals($logger, $pdftotext->getProcessRunner()->getLogger());
    }

    public function testCreateWithConfig()
    {
        $conf = new Configuration();
        $pdftotext = Pdftotext::create($this->createLoggerMock(), $conf);
        $this->assertEquals($conf, $pdftotext->getConfiguration());
    }

    /**
     * @expectedException \Poppler\Exception\ExecutableNotFoundException
     */
    public function testCreateFailureThrowsAnException()
    {
        Pdftotext::create($this->createLoggerMock(), array('pdftotext.binaries' => '/path/to/nowhere'));
    }
}