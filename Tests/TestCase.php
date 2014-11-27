<?php

namespace Poppler\Tests;

use Monolog\Logger;
use Poppler\Driver\Pdfinfo;
use Poppler\Driver\Pdftohtml;
use Poppler\Driver\Pdftotext;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Logger
     */
    protected function createLoggerMock()
    {
        return $this
            ->getMockBuilder('Monolog\Logger')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Pdfinfo
     */
    protected function createPdfinfoMock()
    {
        return $this->getMockBuilder('Poppler\Driver\Pdfinfo')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Pdftotext
     */
    protected function createPdftotextMock()
    {
        return $this->getMockBuilder('Poppler\Driver\Pdftotext')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Pdftohtml
     */
    protected function createPdftohtmlMock()
    {
        return $this->getMockBuilder('Poppler\Driver\Pdftohtml')
            ->disableOriginalConstructor()
            ->getMock();
    }
}