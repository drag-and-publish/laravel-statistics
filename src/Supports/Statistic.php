<?php

namespace LaravelReady\Statistics\Supports;

use LaravelReady\Statistics\Supports\Device;
use LaravelReady\Statistics\Models\Statistic as StatisticModel;

class Statistic
{
    public static function touch(): void
    {
        $uaData = Device::parseUserAgent();

        $statistic = StatisticModel::where('client_hash', $uaData['hash'])->first();

        if ($statistic) {
            $statistic->views = $statistic->views + 1;
            $statistic->save();
        } else {
            $statistic = StatisticModel::create([
                'ip' => Device::getIp(),
                'ua_header' => $uaData['data']['ua_header'],
                'city' => null,
                'country' => null,
                'country_alpha2' => null,
                'client' => $uaData['data']['client'],
                'client_type' => $uaData['data']['client_type'],
                'client_version' => $uaData['data']['client_version'],
                'client_hash' => $uaData['hash'],
                'browser_lang' => Device::getBrowserLang(),
                'referrer' => request()->header('Referer'),
                'views' => 1,
                'is_bot' => $uaData['data']['is_bot'],
                'is_touchable' => $uaData['data']['is_touchable'],
                'is_mobile' => $uaData['data']['is_mobile'],
                'is_desktop' => $uaData['data']['is_desktop'],
                'device_type' => $uaData['data']['device_type'],
                'device_brand' => $uaData['data']['device_brand'],
                'device_model' => $uaData['data']['device_model'],
                'os_name' => $uaData['data']['os_name'],
                'os_version' => $uaData['data']['os_version'],
                'platform' => $uaData['data']['platform'],
            ]);
        }
    }
}
