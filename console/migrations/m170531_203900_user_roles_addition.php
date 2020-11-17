<?php

use yii\db\Migration;
use yii\base\InvalidConfigException;
use yii\rbac\DbManager;

class m170531_203900_user_roles_addition extends Migration
{
    /**
     * @throws yii\base\InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }

    public function safeUp()
    {
        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;

        $this->batchInsert($authManager->itemTable, ['type', 'name', 'description'], [
            [1, 'user', 'User'],
            [1, 'admin', 'Admin'],
        ]);

        $this->batchInsert($authManager->itemChildTable, ['parent', 'child'], [
            ['admin', 'user'],
        ]);

        $this->execute('INSERT INTO'.$authManager->assignmentTable.'(item_name, user_id) SELECT \'user\', u.id FROM {{%users}} u ORDER BY u.id');
    }

    public function down()
    {
        $this->delete('{{%auth_items}}', ['name' => ['user', 'admin']]);
    }
}
