<?php

/*
 * This file is part of php-poppler.
 *
 * (c) Stephan Wentz <stephan@wentz.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Poppler\Driver;

/**
 * pdftotext options
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class PdftotextOptions
{
    /**
     * @var array
     */
    private $options = array();

    /**
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function setOption($key, $value = null)
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set -f
     * first page to convert
     *
     * @param string $page
     *
     * @return $this
     */
    public function first($page)
    {
        return $this->setOption('-f', (integer) $page);
    }

    /**
     * Set -l
     * last page to convert
     *
     * @param integer $page
     *
     * @return $this
     */
    public function last($page)
    {
        return $this->setOption('-l', (integer) $page);
    }

    /**
     * Set -r <resolution>
     * resolution, in DPI (default is 72)
     *
     * @param integer $resolution
     *
     * @return $this
     */
    public function resolution($resolution)
    {
        return $this->setOption('-r', (integer) $resolution);
    }

    /**
     * Set -x
     * x-coordinate of the crop area top left corner
     *
     * @param integer $xCoordinate
     *
     * @return $this
     */
    public function xCoordinate($xCoordinate)
    {
        return $this->setOption('-x', (integer) $xCoordinate);
    }

    /**
     * Set -y
     * y-coordinate of the crop area top left corner
     *
     * @param integer $yCoordinate
     *
     * @return $this
     */
    public function yCoordinate($yCoordinate)
    {
        return $this->setOption('-y', (integer) $yCoordinate);
    }

    /**
     * Set -W
     * width of crop area in pixels (default is 0)
     *
     * @param integer $width
     *
     * @return $this
     */
    public function width($width)
    {
        return $this->setOption('-W', (integer) $width);
    }

    /**
     * Set -H
     * hidth of crop area in pixels (default is 0)
     *
     * @param integer $height
     *
     * @return $this
     */
    public function height($height)
    {
        return $this->setOption('-H', (integer) $height);
    }

    /**
     * Set -layout
     * maintain original physical layout
     *
     * @return $this
     */
    public function layout()
    {
        return $this->setOption('layout');
    }

    /**
     * Set -fixed
     * assume fixed-pitch (or tabular) text
     *
     * @param string $fp
     *
     * @return $this
     */
    public function fixed($fp)
    {
        return $this->setOption('-fixed', $fp);
    }

    /**
     * Set -raw
     * keep strings in content stream order
     *
     * @return $this
     */
    public function raw()
    {
        return $this->setOption('-raw');
    }

    /**
     * Set -htmlmeta
     * generate a simple HTML file, including the meta information
     *
     * @return $this
     */
    public function htmlMeta()
    {
        return $this->setOption('-htmlmeta');
    }

    /**
     * Set --enc <value>
     * output text encoding name
     *
     * @param string $value
     *
     * @return $this
     */
    public function encoding($value)
    {
        return $this->setOption('-enc', $value);
    }

    /**
     * Set -eol
     * output end-of-line convention (unix, dos, or mac)
     *
     * @param string $eol
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function eol($eol)
    {
        if (!in_array($eol, array('unix', 'dos', 'mac'))) {
            throw new \InvalidArgumentException('eol has to be one of unix, dos or mac.');
        }

        return $this->setOption('-eol', $eol);
    }

    /**
     * Set -nopgbrk
     * don't insert page breaks between pages
     *
     * @return $this
     */
    public function noPageBreak()
    {
        return $this->setOption('-nopgbrk');
    }

    /**
     * Set -bbox
     * output bounding box for each word and page size to html.  Sets -htmlmeta
     *
     * @return $this
     */
    public function boundingBox()
    {
        return $this->setOption('-bbox');
    }

    /**
     * Set -opw
     * owner password (for encrypted files)
     *
     * @param string $ownerPassword
     *
     * @return $this
     */
    public function ownerPassword($ownerPassword)
    {
        return $this->setOption('-opw', $ownerPassword);
    }

    /**
     * Set -upw
     * user password (for encrypted files)
     *
     * @param boolean $userPassword
     *
     * @return $this
     */
    public function userPassword($userPassword)
    {
        return $this->setOption('upw', $userPassword);
    }

    /**
     * Set -q
     * don't print any messages or errors
     *
     * @return $this
     */
    public function quiet()
    {
        return $this->setOption('quiet');
    }
}
