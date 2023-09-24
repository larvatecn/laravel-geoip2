# laravel-geoip2

<p align="center">Laravel 的 geoip2 位置查询模块</p>

<p align="center">
<a href="https://packagist.org/packages/larva/laravel-geoip2"><img src="https://poser.pugx.org/larva/laravel-geoip2/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/larva/laravel-geoip2"><img src="https://poser.pugx.org/larva/laravel-geoip2/v/unstable.svg" alt="Latest Unstable Version"></a>
</p>

## 简介

- 该插件自带ip本地库，存放于`/database`； 最后更新时间：2023-08-10 **(空了就时不时更新一下)**
- `webman-ip-attribution` 是基于`geoip2`作为底层，依托 `mmdb数据库` 查询ip归属地及asn信息
- 本项目基于[geoip2/geoip2](https://github.com/maxmind/GeoIP2-php)，感谢[MaxMind](https://github.com/maxmind) 工作组的开源
- 本项目基于[workbunny/webman-ip-attribution](https://github.com/workbunny/webman-ip-attribution)，感谢[workbunny](https://github.com/workbunny) 的开源
- 
## 安装
```shell
composer require larva/laravel-geoip2
```
## 使用

### 配置

#### 在 Laravel 中使用

**注：配置可选填**

```php
return [
    'enable' => true,
    
    'default'  => '--',      // 缺省展示值
    'language' => ['zh-CN'], // 语言

    'db-country' => null,    // 自定义的country库绝对地址
    'db-city'    => null,    // 自定义的city库绝对地址
    'db-asn'     => null,    // 自定义的asn库绝对地址
];
```

### 快速获取
```php
use Larva\GeoIp2\GeoIp2;
use Larva\GeoIp2\InvalidArgumentException;

try {
     var_dump(GeoIp2::getLocation('8.8.8.8')); // ipv4
     var_dump(GeoIp2::getLocation('::0808:0808')); // ipv6
//     [
//         'country' => 'United States',
//         'city' => '--',
//         'asn' => 'GOOGLE',
//         'continent' => 'North America',
//         'timezone' => 'America/Chicago',
//     ]
 }catch (InvalidArgumentException $exception){
 
 }
```

### 使用city库查询

**注：City库包含了 大洲、国家、城市，但不包含网络运营商等相关信息**

```php
use Larva\GeoIp2\GeoIp2;
use Larva\GeoIp2\InvalidArgumentException;

try {
    var_dump(GeoIp2::city('8.8.8.8')); // ipv4
    var_dump(GeoIp2::city('::0808:0808')); // ipv6
    // 返回 GeoIp2\Model\City 对象
    
 }catch (IpAttributionException $exception){
 
 }
```

### 使用country库查询

**注：Country库不包含城市及网络运营商等信息，通常使用City库即可，Country存在的意义在于较于City更轻**

```php
use Larva\GeoIp2\GeoIp2;
use Larva\GeoIp2\InvalidArgumentException;

try {
    var_dump(GeoIp2::country('8.8.8.8')); // ipv4
    var_dump(GeoIp2::country('::0808:0808')); // ipv6
    // 返回 GeoIp2\Model\Country 对象
    
 }catch (IpAttributionException $exception){
 
 }
```

### 使用asn库查询

**注：Asn库仅包含网络运营商等相关信息**

```php
use Larva\GeoIp2\GeoIp2;
use Larva\GeoIp2\InvalidArgumentException;

try {
    var_dump(GeoIp2::asn('8.8.8.8')); // ipv4
    var_dump(GeoIp2::asn('::0808:0808')); // ipv6
    // 返回 GeoIp2\Model\Asn 对象
    
 }catch (IpAttributionException $exception){
 
 }
```

### 使用原始Reader操作

**注：原始Reader可以直接使用 [geoip2/geoip2](https://github.com/maxmind/GeoIP2-php) 提供的方法操作相关的库**

```php
use Larva\GeoIp2\GeoIp2;
use Larva\GeoIp2\InvalidArgumentException;

var_dump(GeoIp2::createReader(Location::DB_CITY)); // City库
// 返回连接City库的 GeoIp2\Database\Reader 对象
var_dump(GeoIp2::createReader(Location::DB_ASN)); // ASN库
// 返回连接ASN库的 GeoIp2\Database\Reader 对象   
var_dump(GeoIp2::createReader(Location::DB_ASN)); // Country库
// 返回连接Country库的 GeoIp2\Database\Reader 对象
```

更多用法和示例参照 [geoip2/geoip2](https://github.com/maxmind/GeoIP2-php)；
