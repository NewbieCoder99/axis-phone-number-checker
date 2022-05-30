<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SaveAndGetCache;

class TestController extends Controller
{
    public function index()
    {
        $data = SaveAndGetCache::get('eyJpdiI6IjRMT3RDTUp4aGk5RUtyR0hycGtteVE9PSIsInZhbHVlIjoiTUE4SkZMS21RZHRaUFBYa1RKWHZjR2pRblVtZFJTWFl1T3d6eGpOSHZsVzZkOXh3THMyUXBQOXB4TTJPdkwzUnJrSnFWSVJjdm1aWk9Bdm00YUVoRm9oaktKMjl2NzA0TjQvdWE2RGpzZ2trbFd5WVh3d2c2L3R3MDA4ZkIrekgiLCJtYWMiOiJiNGU5MzI0NWYzNGVkYzU3MDRlZmY2ZDY2MzVhMTg5ZTVkODc0NmI2ZmI2ZWQ4NDYzMzA4ZjRkZjAwOTU0NDA4IiwidGFnIjoiIn0=');

        $data = str_replace('"083104251084",','', $data);

        return json_decode($data, true);
    }
}
