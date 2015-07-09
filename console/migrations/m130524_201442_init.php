<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => Schema::primaryKey(),
            'username' => Schema::string()->notNull()->unique(),
            'auth_key' => Schema::string(32)->notNull(),
            'password_hash' => Schema::string()->notNull(),
            'password_reset_token' => Schema::string()->unique(),
            'email' => Schema::string()->notNull()->unique(),

            'status' => Schema::smallInteger()->notNull()->default(10),
            'created_at' => Schema::integer()->notNull(),
            'updated_at' => Schema::integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
