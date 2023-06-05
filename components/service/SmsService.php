<?php

declare(strict_types=1);

namespace app\components\service;

final class SmsService
{
    private string $url = 'https://smspilot.ru/api.php';

    private string $key = 'XXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZXXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZ';

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
        $response = file_get_contents("{$this->url}?send={$message}&to={$phone}&apikey={$this->key}&format=json");
        \Yii::$app->getSession()->setFlash('success', 'response = '. $response);

    }
}