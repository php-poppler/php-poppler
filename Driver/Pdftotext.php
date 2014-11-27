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

use Alchemy\BinaryDriver\AbstractBinary;
use Alchemy\BinaryDriver\Configuration;
use Alchemy\BinaryDriver\ConfigurationInterface;
use Alchemy\BinaryDriver\Exception\ExecutableNotFoundException as BinaryDriverExecutableNotFound;
use Poppler\Exception\ExecutableNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * pdftotext binary driver
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class Pdftotext extends AbstractBinary
{
    /**
     * @var boolean
     */
    private $isAvailable;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pdftotext';
    }

    /**
     * @return PdftotextOptions
     */
    public function options()
    {
        return new PdftotextOptions();
    }

    /**
     * Creates an Pdftotext driver.
     *
     * @param LoggerInterface     $logger
     * @param array|Configuration $configuration
     *
     * @return Pdftotext
     */
    public static function create(LoggerInterface $logger = null, $configuration = array())
    {
        if (!$configuration instanceof ConfigurationInterface) {
            $configuration = new Configuration($configuration);
        }

        $binaries = $configuration->get('pdftotext.binaries', 'pdftotext');

        if (!$configuration->has('timeout')) {
            $configuration->set('timeout', 60);
        }

        try {
            return static::load($binaries, $logger, $configuration);
        } catch (BinaryDriverExecutableNotFound $e) {
            throw new ExecutableNotFoundException('Unable to load pdftotext', $e->getCode(), $e);
        }
    }

    /**
     * Check availability
     *
     * @param string $filename
     *
     * @return boolean
     */
    public function isAvailable($filename = null)
    {
        if (null === $this->isAvailable) {
            $output = $this->command('-v');

            if ($output) {
                $version = 'unknown';
                if (preg_match('/^pdftotext version (.+)/', $output, $match)) {
                    $version = $match[1];
                }

                $this->isAvailable = true;

                $this->getProcessRunner()->getLogger()->info("pdftotext is available, version $version");
            } else {
                $this->isAvailable = false;

                $this->getProcessRunner()->getLogger()->warning("pdftotext is not available");
            }
        }

        return $this->isAvailable;
    }

    /**
     * Calls -listenc
     * list available encodings
     *
     * @return string
     */
    public function listEncodings()
    {
        return $this->command('-listenc');
    }
}
