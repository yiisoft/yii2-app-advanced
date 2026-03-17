<?php

declare(strict_types=1);

use yii\db\Migration;

class m190124_110200_add_verification_token_column_to_user_table extends Migration
{
    public function safeUp(): void
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));
    }

    public function safeDown(): void
    {
        $this->dropColumn('{{%user}}', 'verification_token');
    }
}
