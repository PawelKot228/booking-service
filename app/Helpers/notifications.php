<?php

use App\Enums\NotificationType;

if (!function_exists('flashSuccessNotification')) {
    function flashSuccessNotification(string $message): void
    {
        flashNotification(NotificationType::SUCCESS, $message);
    }
}

if (!function_exists('flashErrorNotification')) {
    function flashErrorNotification(string $message): void
    {
        flashNotification(NotificationType::ERROR, $message);
    }
}

if (!function_exists('flashWarningNotification')) {
    function flashWarningNotification(string $message): void
    {
        flashNotification(NotificationType::WARNING, $message);
    }
}

if (!function_exists('flashInfoNotification')) {
    function flashInfoNotification(string $message): void
    {
        flashNotification(NotificationType::INFO, $message);
    }
}

if (!function_exists('flashNotification')) {
    function flashNotification(NotificationType $type, string $message): void
    {
        $messages = session('notifications') ?? [];
        $messages[] = $messages;

        session()->flash('notifications', [$messages]);
    }
}
