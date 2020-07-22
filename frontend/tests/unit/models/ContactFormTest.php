<?php
namespace frontend\tests\unit\models;

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

        expect_that($model->sendEmail('admin@example.com'));

        // using Yii2 module actions to check email was sent
        $this->tester->seeEmailIsSent();

        /** @var MessageInterface  $emailMessage */
        $emailMessage = $this->tester->grabLastSentEmail();
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey('admin@example.com');
        expect($emailMessage->getFrom())->hasKey('noreply@example.com');
        expect($emailMessage->getReplyTo())->hasKey('tester@example.com');
        expect($emailMessage->getSubject())->equals('very important letter subject');
        expect($emailMessage->toString())->stringContainsString('body of current message');
    }
}
