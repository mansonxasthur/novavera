<?php


namespace App\Facades;


use Illuminate\Support\Facades\Log;

class Logger
{
    public static function error(\Exception $e): void
    {
        Log::debug($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
    }
}