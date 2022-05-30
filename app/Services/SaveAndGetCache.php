<?php

namespace App\Services;

use Cache;
use Carbon\Carbon;

class SaveAndGetCache
{
    public static function save($key, $result, $toJson = true, $expiredBy = 'days', $expire = 1)
    {
        if ($expiredBy == 'years') {
            $expiresAt = Carbon::now()->addYears($expire);
        } elseif ($expiredBy == 'weeks') {
            $expiresAt = Carbon::now()->addWeeks($expire);
        } elseif ($expiredBy == 'months') {
            $expiresAt = Carbon::now()->addMonths($expire);
        } elseif ($expiredBy == 'days') {
            $expiresAt = Carbon::now()->addDays($expire);
        } elseif ($expiredBy == 'hours') {
            $expiresAt = Carbon::now()->addHours($expire);
        } elseif ($expiredBy == 'minutes') {
            $expiresAt = Carbon::now()->addMinutes($expire);
        } elseif ($expiredBy == 'seconds') {
            $expiresAt = Carbon::now()->addSeconds($expire);
        } else {
            $expiresAt = Carbon::now()->addDays($expire);
        }

        $res = $result;
        if ($toJson) {
            $res = json_encode($result);
        }

        Cache::put($key, $res, $expiresAt);
    }

    public static function get($key)
    {
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        return false;
    }

    public static function forgetCache($cacheName = '')
    {
        return Cache::forget($cacheName);
    }
}
