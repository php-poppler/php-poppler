<?php

/*
 * This file is part of php-poppler.
 *
 * (c) Stephan Wentz <stephan@wentz.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Poppler\Processor;

use Poppler\Driver\Pdfinfo;
use Poppler\Driver\Pdftohtml;
use Poppler\Driver\Pdftotext;
use Poppler\Exception\FileNotFoundException;

/**
 * PDF file
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class PdfFile
{
    /**
     * @var Pdfinfo
     */
    private $pdfinfo;

    /**
     * @var Pdftotext
     */
    private $pdftotext;

    /**
     * @var Pdftohtml
     */
    private $pdftohtml;

    /**
     * @param Pdfinfo   $pdfinfo
     * @param Pdftotext $pdftotext
     * @param Pdftohtml $pdftohtml
     */
    public function __construct(Pdfinfo $pdfinfo, Pdftotext $pdftotext, Pdftohtml $pdftohtml)
    {
        $this->pdfinfo = $pdfinfo;
        $this->pdftotext = $pdftotext;
        $this->pdftohtml = $pdftohtml;
    }

    /**
     * @param string $inputfile
     * @param string $toEncoding
     *
     * @throws FileNotFoundException
     * @return string
     */
    public function toText($inputfile, $toEncoding = 'UTF-8')
    {
        if (!file_exists($inputfile)) {
            throw new FileNotFoundException("File $inputfile not found.");
        }

        $output = $this->pdftotext->command(array('-nopgbrk', $inputfile, '-'));
        $fromEncoding = mb_detect_encoding($output);
        if ($fromEncoding) {
            return mb_convert_encoding($output, $toEncoding, $fromEncoding);
        }

        return mb_convert_encoding($output, $toEncoding);
    }

    /**
     * @param string $inputfile
     * @param string $outputfile
     *
     * @throws FileNotFoundException
     * @return string
     */
    public function toHtml($inputfile, $outputfile)
    {
        if (!file_exists($inputfile)) {
            throw new FileNotFoundException("File $inputfile not found.");
        }

        $output = $this->pdftohtml->command(array($inputfile, $outputfile));

        return $output;
    }

    /**
     * Write to file or return content
     *
     * @param string $inputfile
     *
     * @return array
     */
    public function getInfo($inputfile)
    {
        if (!file_exists($inputfile)) {
            throw new FileNotFoundException("File $inputfile not found.");
        }

        $args = array($inputfile);

        $output = $this->pdfinfo->command($args);

        $info = array();
        foreach (explode(PHP_EOL, $output) as $line) {
            if (strpos($line, ': ') === false) {
                continue;
            }
            $parts = explode(': ', $line);
            $key = trim($parts[0]);
            $value = trim($parts[1]);
            $info[$key] = $value;
        }

        return $info;
    }
}
