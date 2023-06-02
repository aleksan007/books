<?php

declare(strict_types=1);

namespace app\components\service;

final class SmsService
{
    private string $url = 'https://smspilot.ru/api.php';

    private string $key = '7012A713RHPYSMQMX096PH3C73L408680S63U124JJ0T9YIR35ADN7X9MS786LIT';

    private static ?self $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    /**
     * Отправка сообщения
     * @param string $phone
     * @param string $message
     */
    public function send(string $phone, string $message): void
    {
        file_get_contents("{$this->url}?send={$message}&to={$phone}&apikey={$this->key}&format=json");
    }
}