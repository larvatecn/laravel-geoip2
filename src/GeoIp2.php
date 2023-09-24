<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 */
namespace Larva\GeoIp2;

use Illuminate\Support\Facades\Facade;

/**
 * Class Ip2Region
 * @method static array|mixed find(string $ip)
 * @method static array|mixed memorySearch(string $ip)
 * @method static array|mixed binarySearch(string $ip)
 * @method static array|mixed btreeSearch(string $ip)
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class GeoIp2 extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'geoip2';
    }
}