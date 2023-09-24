<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 */
namespace Larva\GeoIp2;

use GeoIp2\Database\Reader;
use GeoIp2\Model\Asn;
use GeoIp2\Model\City;
use GeoIp2\Model\Country;
use Illuminate\Support\Facades\Facade;

/**
 * Class GeoIp2
 * @method static array getLocation(string $ip)
 * @method static array getReaders()
 * @method static Reader createReader(string $db)
 * @method static City city(string $ip)
 * @method static Asn asn(string $ip)
 * @method static Country country(string $ip)
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