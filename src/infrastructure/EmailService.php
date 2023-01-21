<?php

namespace omarinina\infrastructure;

class EmailService
{
    public function send($email, $message)
    {
        \Yii::info('Привет, Ольга: ' . $message);
    }

    public function generateMessage($data): string
    {
        return '123';
    }
}