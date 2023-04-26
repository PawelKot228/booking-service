<?php

if (!function_exists('logError')) {
    function logError(Throwable $throwable): void
    {
        Log::error("{$throwable->getMessage()} - {$throwable->getFile()}@{$throwable->getLine()}");
    }
}
