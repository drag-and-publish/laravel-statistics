<?php

namespace LaravelReady\Statistics\Supports;

use DeviceDetector\DeviceDetector;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use LaravelReady\UltimateSupport\Supports\IpSupport;

class Detector
{
    public static function parseUserAgent(string|null $userAgent = null): array
    {
        $hash = self::getClientHash($userAgent);

        if (Cache::has($hash)) {
            $data = Cache::get($hash);
        } else {
            $deviceDetector = new DeviceDetector($userAgent ?: request()->header('User-Agent'));
            $deviceDetector->parse();

            $client = $deviceDetector->getClient();
            $os = $deviceDetector->getOs();

            $data = [
                'is_bot' => $deviceDetector->isBot(),
                'is_touchable' => $deviceDetector->isTouchEnabled(),
                'is_mobile' => $deviceDetector->isMobile(),
                'is_desktop' => $deviceDetector->isDesktop(),
                'client' => $client && $client['name'] ? $client['name'] : null,
                'client_type' => $client && $client['type'] ? $client['type'] : null,
                'client_version' => $client && $client['version'] ? $client['version'] : null,
                'device_type' => $deviceDetector->getDeviceName(),
                'device_brand' => $deviceDetector->getBrandName(),
                'device_model' => $deviceDetector->getModel(),
                'ua_header' => $deviceDetector->getUserAgent(),
                'os_name' => $os && $os['name'] ? $os['name'] : null,
                'os_version' => $os && $os['version'] ? $os['version'] : null,
                'platform' => $os && $os['platform'] ? $os['platform'] : null
            ];

            Cache::put($hash, $data, now()->days(1));
        }

        return [
            'hash' => $hash,
            'data' => $data
        ];
    }

    public static function getBrowserLang()
    {
        $lang = request()->header('Accept-Language');
        $lang = explode(',', $lang);
        $lang = explode(';', $lang[0] ?? []);
        $lang = $lang[0] ?? null;

        return $lang;
    }

    public static function getReferrer()
    {
        $referrer = request()->header('Referer');

        return $referrer;
    }

    public static function getIp()
    {
        $ip = IpSupport::getIpAddress(false);

        return $ip;
    }

    private static function getClientHash(string | null $userAgent = null): string
    {
        $useragent = $userAgent ?? request()->header('User-Agent');
        $ip = self::getIp();
        $date = date('Y-m-d');

        $hash = md5("{$useragent}.{$ip['ip_address']}.{$date}");

        return $hash;
    }
}
