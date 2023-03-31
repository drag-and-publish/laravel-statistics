<?php

namespace LaravelReady\Statistics\Supports;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use LaravelReady\Statistics\Supports\Device;
use LaravelReady\Statistics\Models\Statistic as StatisticModel;

class Statistic
{
    public static function touch(Model $model = null): void
    {
        $uaData = Device::parseUserAgent();

        $statistic = StatisticModel::where('client_hash', $uaData['hash'])->first();

        if ($statistic) {
            $statistic->views = $statistic->views + 1;
            $statistic->save();
        } else {
            $data = [
                'statisticable_type' => $model ? get_class($model) : null,
                'statisticable_id' => $model ? $model->id : null,
                'ip' => Device::getIp()['ip_address'],
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
            ];

            $statistic = StatisticModel::create($data);
        }
    }

    public static function processIpData(): void
    {
        $ipDataUnprocessedStatistics = StatisticModel::where('is_ip_parsed', false)->limit(
            Config::get('statistics.ip2location.process_ip_data_per_cycle', 1000)
        )->get();
        $ip2Location = new Ip2Location();

        foreach ($ipDataUnprocessedStatistics as $statistic) {
            $ipData = $ip2Location->getIpData($statistic->ip);

            if ($ipData) {
                $statistic->city = $ipData->city_name;
                $statistic->country = $ipData->country_name;
                $statistic->country_alpha2 = Str::lower($ipData->country_code);
            }

            $statistic->is_ip_parsed = true;
            $statistic->save();
        }
    }
}
