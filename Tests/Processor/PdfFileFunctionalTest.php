<?php

namespace Poppler\Tests\Processor;

use Poppler\Driver\Pdfinfo;
use Poppler\Driver\Pdftotext;
use Poppler\Processor\PdfFile;
use Poppler\Tests\TestCase;

class PdfFileFunctionalTest extends TestCase
{
    public function testGetInfo()
    {
        $pdfFile = new PdfFile(
            Pdfinfo::create($this->createLoggerMock()),
            $this->createPdftotextMock(),
            $this->createPdftohtmlMock()
        );
        $info = $pdfFile->getInfo(__DIR__ . '/../files/pdf-sample.pdf');

        $this->assertNotEmpty($info);
        $this->assertInternalType('array', $info);
        $this->assertSame('This is a test PDF file', $info['Title']);
        $this->assertSame('1', $info['Pages']);
        $this->assertSame('1.3', $info['PDF version']);
        $this->assertSame('Thu Jun 29 10:21:08 2000', $info['CreationDate']);
    }

    public function testToText()
    {
        $pdfFile = new PdfFile(
            $this->createPdfinfoMock(),
            Pdftotext::create($this->createLoggerMock()),
            $this->createPdftohtmlMock()
        );
        $text = $pdfFile->toText(__DIR__ . '/../files/pdf-sample.pdf');

        $this->assertNotEmpty($text);
        $this->assertEquals($this->createTextContent(), $text);
    }

    private function createTextContent()
    {
        $text = "Adobe Acrobat PDF Files
Adobe® Portable Document Format (PDF) is a universal file format that preserves all
of the fonts, formatting, colours and graphics of any source document, regardless of
the application and platform used to create it.
Adobe PDF is an ideal format for electronic document distribution as it overcomes the
problems commonly encountered with electronic file sharing.
•

Anyone, anywhere can open a PDF file. All you need is the free Adobe Acrobat
Reader. Recipients of other file formats sometimes can't open files because they
don't have the applications used to create the documents.

•

PDF files always print correctly on any printing device.

•

PDF files always display exactly as created, regardless of fonts, software, and
operating systems. Fonts, and graphics are not lost due to platform, software, and
version incompatibilities.

•

The free Acrobat Reader is easy to download and can be freely distributed by
anyone.

•

Compact PDF files are smaller than their source files and download a
page at a time for fast display on the Web.

";

        return ($text);
    }
}