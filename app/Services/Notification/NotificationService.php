<?php

namespace App\Services\Notification;

class NotificationService
{
    public static function addSessionNotification(string $notification, string $type = 'info'): void
    {
        $notifications = session('notifications') ?? [];
        $notifications[$type][] = $notification;

        session(['notifications' => $notifications]);
    }

    public static function getAllSessionNotifications(): array
    {
        return session('notifications') ?? [];
    }

    public static function getAllDatabaseNotifications(): array
    {
        return [];
    }

    public static function getAllNotifications(): array
    {
        return array_merge(
            self::getAllSessionNotificationsAndRemove(),
            self::getAllDatabaseNotifications()
        );
    }

    public static function removeAllSessionNotifications(): void
    {
        session()->remove('notifications');
    }

    public static function getAllSessionNotificationsAndRemove(): array
    {
        $notifications = self::getAllSessionNotifications();
        self::removeAllSessionNotifications();

        return $notifications;
    }
}
