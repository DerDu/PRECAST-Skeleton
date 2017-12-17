<?php

namespace PRECAST\Vendor\Factory\Contract;


use PRECAST\Vendor\Factory\FactoryInterface;

/**
 * Interface CacheInterface
 * @see http://www.php-fig.org/psr/psr-16/
 * @package PRECAST\Vendor\Factory\Contract
 */
interface CacheInterface extends FactoryInterface
{
    /**
     * Fetches a value from the cache.
     *
     * @param string $Key The unique key of this item in the cache.
     * @param mixed $Default Default value to return if the key does not exist.
     *
     * @return mixed The value of the item from the cache, or $Default in case of cache miss.
     *
     * @throws \Exception
     *   MUST be thrown if the $Key string is not a legal value.
     */
    public function get($Key, $Default = null);

    /**
     * Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time.
     *
     * @param string $Key The key of the item to store.
     * @param mixed $Value The value of the item to store, must be serializable.
     * @param null|int|\DateInterval $TTL Optional. The TTL value of this item. If no value is sent and
     *                                      the driver supports TTL then the library may set a default value
     *                                      for it or let the driver take care of that.
     *
     * @return bool True on success and false on failure.
     *
     * @throws \Exception
     *   MUST be thrown if the $Key string is not a legal value.
     */
    public function set($Key, $Value, $TTL = null);

    /**
     * Delete an item from the cache by its unique key.
     *
     * @param string $Key The unique cache key of the item to delete.
     *
     * @return bool True if the item was successfully removed. False if there was an error.
     *
     * @throws \Exception
     *   MUST be thrown if the $Key string is not a legal value.
     */
    public function delete($Key);

    /**
     * Wipes clean the entire cache's keys.
     *
     * @return bool True on success and false on failure.
     */
    public function clear();

    /**
     * Obtains multiple cache items by their unique keys.
     *
     * @param iterable $Keys A list of keys that can obtained in a single operation.
     * @param mixed $Default Default value to return for keys that do not exist.
     *
     * @return iterable A list of key => value pairs.
     * Cache keys that do not exist or are stale will have $Default as value.
     *
     * @throws \Exception
     *   MUST be thrown if $Keys is neither an array nor a Traversable,
     *   or if any of the $Keys are not a legal value.
     */
    public function getMultiple($Keys, $Default = null);

    /**
     * Persists a set of key => value pairs in the cache, with an optional TTL.
     *
     * @param iterable $Values A list of key => value pairs for a multiple-set operation.
     * @param null|int|\DateInterval $TTL Optional. The TTL value of this item. If no value is sent and
     *                                       the driver supports TTL then the library may set a default value
     *                                       for it or let the driver take care of that.
     *
     * @return bool True on success and false on failure.
     *
     * @throws \Exception
     *   MUST be thrown if $Values is neither an array nor a Traversable,
     *   or if any of the $Values are not a legal value.
     */
    public function setMultiple($Values, $TTL = null);

    /**
     * Deletes multiple cache items in a single operation.
     *
     * @param iterable $Keys A list of string-based keys to be deleted.
     *
     * @return bool True if the items were successfully removed. False if there was an error.
     *
     * @throws \Exception
     *   MUST be thrown if $Keys is neither an array nor a Traversable,
     *   or if any of the $Keys are not a legal value.
     */
    public function deleteMultiple($Keys);

    /**
     * Determines whether an item is present in the cache.
     *
     * NOTE: It is recommended that has() is only to be used for cache warming type purposes
     * and not to be used within your live applications operations for get/set, as this method
     * is subject to a race condition where your has() will return true and immediately after,
     * another script can remove it making the state of your app out of date.
     *
     * @param string $Key The cache item key.
     *
     * @return bool
     *
     * @throws \Exception
     *   MUST be thrown if the $Key string is not a legal value.
     */
    public function has($Key);
}
