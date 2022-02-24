<?php

namespace frontend\tests\unit\models;

use Codeception\Verify\Verify;
use frontend\models\ContactForm;
use yii\mail\MessageInterface;

class ContactFormTest extends \Codeception\Test\Unit
{
    public function testSendEmail()
    {
        $model = new ContactForm();

        $model->attributes = [
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body' => 'body of current message',
        ];

        if (PHP_VERSION_ID >= 70400) {
            expect($model->sendEmail('admin@example.com'))->toBeTrue();
        } else {
            expect_that($model->sendEmail('admin@example.com'));
        }

        // using Yii2 module actions to check email was sent
        $this->tester->seeEmailIsSent();

        /** @var MessageInterface  $emailMessage */
        $emailMessage = $this->tester->grabLastSentEmail();
        if (PHP_VERSION_ID >= 70400) {
            expect($emailMessage)->toBeInstanceOf(MessageInterface::class, 'valid email is sent');
            expect($emailMessage->getTo())->arrayToHaveKey('admin@example.com');
            expect($emailMessage->getFrom())->arrayToHaveKey('noreply@example.com');
            expect($emailMessage->getReplyTo())->arrayToHaveKey('tester@example.com');
            expect($emailMessage->getSubject())->toBe('very important letter subject');
            expect($emailMessage->toString())->stringToContainString('body of current message');
            return;
        }
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey('admin@example.com');
        expect($emailMessage->getFrom())->hasKey('noreply@example.com');
        expect($emailMessage->getReplyTo())->hasKey('tester@example.com');
        expect($emailMessage->getSubject())->equals('very important letter subject');
        expect($emailMessage->toString())->stringContainsString('body of current message');
    }
}
