<?php

namespace src\Decorator;

use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use src\Integration\DataProvider;

class DecoratorManager extends DataProvider
{
    private $cache;
    private $logger;

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param CacheItemPoolInterface $cache
     */
    public function __construct($host, $user, $password, CacheItemPoolInterface $cache)
    {
        parent::__construct($host, $user, $password);
        $this->cache = $cache;
    }

    /**
     * For change logger
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param array $input
     * @return array
     */
    public function getResponse(array $input)
    {
        $result = [];

        try {
            $cacheKey = $this->json_encode($input);
            $cacheItem = $this->cache->getItem($cacheKey);

            if ($cacheItem->isHit())
            {
                $result = $cacheItem->get();
            }
            else
            {
                $result = parent::get($input);
            }

            $cacheItem
                ->set($result)
                ->expiresAt(
                    (new DateTime())->modify('+1 day')
                );
        } catch (Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $result;
    }
}
