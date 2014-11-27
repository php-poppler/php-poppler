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
 * pdftohtml options
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class PdftohtmlOptions
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
