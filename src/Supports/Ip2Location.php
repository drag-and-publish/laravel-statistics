<?php

namespace LaravelReady\Statistics\Supports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use LaravelReady\Statistics\Supports\Device;
use LaravelReady\Statistics\Models\Statistic as StatisticModel;

class Ip2Location
{
    public function __construct()
    {
        Config::set('database.connections.ip2location', [
            'driver' => 'mysql',
            'host' => Config::get('statistics.ip2location.database.host'),
            'port' => Config::get('statistics.ip2location.database.port'),
            'database' => Config::get('statistics.ip2location.database.database'),
            'username' => Config::get('statistics.ip2location.database.username'),
            'password' => Config::get('statistics.ip2location.database.password'),
        ]);
    }

    public function getIpData(string $ipAddress): mixed
    {
        $ipData = DB::connection('ip2location')
            ->table('ip2location_database')
            ->where('ip_from', '<=', ip2long($ipAddress))
            ->where('ip_to', '>=', ip2long($ipAddress))
            ->first();

        return $ipData;
    }
}
