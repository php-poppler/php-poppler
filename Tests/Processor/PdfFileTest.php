<?php

namespace Poppler\Tests\Processor;

use Poppler\Processor\PdfFile;
use Poppler\Tests\TestCase;

class PdfFileTest extends TestCase
{
    /**
     * @expectedException \Poppler\Exception\FileNotFoundException
     */
    public function testGetInfoFromInvalid()
    {
        $pdfFile = new PdfFile($this->createPdfinfoMock(), $this->createPdftotextMock(), $this->createPdftohtmlMock());
        $pdfFile->getInfo('/path/to/nowhere');
    }

    public function testGetInfo()
    {
        $pdfFile = new PdfFile($this->createPdfinfoMock(), $this->createPdftotextMock(), $this->createPdftohtmlMock());
        $info = $pdfFile->getInfo(__DIR__ . '/../files/pdf-sample.pdf');
    }

    /**
     * @expectedException \Poppler\Exception\FileNotFoundException
     */
    public function testToTextFromInvalid()
    {
        $pdfFile = new PdfFile($this->createPdfinfoMock(), $this->createPdftotextMock(), $this->createPdftohtmlMock());
        $pdfFile->toText('/path/to/nowhere');
    }

    public function testToText()
    {
        $pdfFile = new PdfFile($this->createPdfinfoMock(), $this->createPdftotextMock(), $this->createPdftohtmlMock());
        $text = $pdfFile->toText(__DIR__ . '/../files/pdf-sample.pdf');
    }

    /**
     * @expectedException \Poppler\Exception\FileNotFoundException
     */
    public function testToHtmlFromInvalid()
    {
        $pdfFile = new PdfFile($this->createPdfinfoMock(), $this->createPdftotextMock(), $this->createPdftohtmlMock());
        $pdfFile->toHtml('/path/to/nowhere', sys_get_temp_dir());
    }

    public function testToHtml()
    {
        $pdfFile = new PdfFile($this->createPdfinfoMock(), $this->createPdftotextMock(), $this->createPdftohtmlMock());
        $pdfFile->toHtml(__DIR__ . '/../files/pdf-sample.pdf', sys_get_temp_dir());
    }
}