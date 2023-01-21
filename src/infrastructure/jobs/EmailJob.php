<?php

namespace omarinina\infrastructure\jobs;

use omarinina\infrastructure\EmailService;
use yii\queue\JobInterface;
use yii\queue\Queue;
use Yii;

class EmailJob implements JobInterface
{
    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $data;

    /**
     * @var EmailService
     */
    private EmailService $emailService;

    /**
     * @param string $email
     * @param string $messagePattern
     * @param EmailService $emailService
     */
    public function __construct(
        string $email,
        string $data
    ) {
        $this->email = $email;
        $this->data = $data;
        $this->emailService = new EmailService();
    }

    public function execute($queue)
    {
        $this->emailService->send(
            $this->email,
            $this->emailService->generateMessage($this->data)
        );
    }
}