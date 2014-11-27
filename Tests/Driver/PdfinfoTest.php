<?php
namespace Poppler\Tests\Driver;

use Alchemy\BinaryDriver\Configuration;
use Poppler\Driver\Pdfinfo;
use Poppler\Tests\TestCase;
use Symfony\Component\Process\ExecutableFinder;

class PdfinfoTest extends TestCase
{
    public function setUp()
    {
        $executableFinder = new ExecutableFinder();
        $found = false;
        foreach (array('pdfinfo') as $name) {
            if (null !== $executableFinder->find($name)) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $this->markTestSkipped('pdfinfo not found');
        }
    }

    public function testCreate()
    {
        $logger = $this->createLoggerMock();
        $pdfinfo = Pdfinfo::create($logger, array());
        $this->assertInstanceOf('Poppler\Driver\Pdfinfo', $pdfinfo);
        $this->assertEquals($logger, $pdfinfo->getProcessRunner()->getLogger());
    }

    public function testCreateWithConfig()
    {
        $conf = new Configuration();
        $pdfinfo = Pdfinfo::create($this->createLoggerMock(), $conf);
        $this->assertEquals($conf, $pdfinfo->getConfiguration());
    }

    /**
     * @expectedException \Poppler\Exception\ExecutableNotFoundException
     */
    public function testCreateFailureThrowsAnException()
    {
        Pdfinfo::create($this->createLoggerMock(), array('pdfinfo.binaries' => '/path/to/nowhere'));
    }
}