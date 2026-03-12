<?php

declare(strict_types=1);

namespace frontend\tests\Unit\Models;

use Codeception\Test\Unit;
use frontend\models\ContactForm;
use frontend\tests\Support\UnitTester;
use yii\mail\MessageInterface;

final class ContactFormTest extends Unit
{
    protected UnitTester $tester;

    public function testSendEmail(): void
    {
        $model = new ContactForm();

        $model->attributes = [
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body' => 'body of current message',
        ];

        verify($model->sendEmail('admin@example.com'))
            ->notEmpty();

        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();

        verify($emailMessage)
            ->instanceOf(MessageInterface::class);
        verify($emailMessage->getTo())
            ->arrayHasKey('admin@example.com');
        verify($emailMessage->getFrom())
            ->arrayHasKey('noreply@example.com');
        verify($emailMessage->getReplyTo())
            ->arrayHasKey('tester@example.com');
        verify($emailMessage->getSubject())
            ->equals('very important letter subject');
        verify($emailMessage->toString())
            ->stringContainsString('body of current message');
    }
}
