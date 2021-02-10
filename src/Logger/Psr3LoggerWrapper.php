<?php
/*!
* Arifauth
* https://Arifauth.github.io | https://github.com/Arifauth/Arifauth
*  (c) 2017 Arifauth authors | https://Arifauth.github.io/license.html
*/

namespace Arifauth\Logger;

use Psr\Log\LoggerAwareTrait;

/**
 * Wrapper for PSR3 logger.
 */
class Psr3LoggerWrapper implements LoggerInterface
{
    use LoggerAwareTrait;

    /**
     * @inheritdoc
     */
    public function info($message, array $context = [])
    {
        $this->logger->info($message, $context);
    }

    /**
     * @inheritdoc
     */
    public function debug($message, array $context = [])
    {
        $this->logger->debug($message, $context);
    }

    /**
     * @inheritdoc
     */
    public function error($message, array $context = [])
    {
        $this->logger->error($message, $context);
    }

    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = [])
    {
        $this->logger->log($level, $message, $context);
    }
}
