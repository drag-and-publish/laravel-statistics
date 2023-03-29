<?php

namespace LaravelReady\Statistics\Supports;

use DeviceDetector\DeviceDetector;

class Device
{
    public static function parseUserAgent()
    {
        $useragent = request()->header('User-Agent');

        $deviceDetector = new DeviceDetector($useragent);
        $client = $deviceDetector->getClient();
        $os = $deviceDetector->getOs();

        $data = [
            'is_bot' => $deviceDetector->isBot(),
            'is_touchable' => $deviceDetector->isTouchEnabled(),
            'is_mobile' => $deviceDetector->isMobile(),
            'is_desktop' => $deviceDetector->isDesktop(),
            'client' => $client['name'] ? $client['name'] : null,
            'client_type' => $client['type'] ? $client['type'] : null,
            'client_version' => $client['version'] ? $client['version'] : null,
            'device_type' => $deviceDetector->getDeviceName(),
            'device_brand' => $deviceDetector->getBrandName(),
            'device_model' => $deviceDetector->getModel(),
            'ua_header' => $deviceDetector->getUserAgent(),
            'os_name' => $os['name'] ? $os['name'] : null,
            'os_version' => $os['version'] ? $os['version'] : null,
            'platform' => $os['platform'] ? $os['platform'] : null
        ];

        return $data;
    }
}
