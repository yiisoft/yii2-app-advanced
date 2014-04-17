<?php

namespace app\tools;

use yii\mongodb\Connection;
use \Yii;

/**
 * Description of MongoTarget
 *
 * @author MDMunir
 */
class MongoTarget extends \yii\log\Target
{

    /**
     *
     * @var Connection 
     */
    public $db = 'mongodb';
    public $logCollection = 'app_log';
    private $_idLog;

    public function init()
    {
        parent::init();
        if (is_string($this->db)) {
            $this->db = Yii::$app->get($this->db);
        }
        if (!$this->db instanceof Connection) {
            throw new InvalidConfigException("DbTarget::db must be either a MongoDB connection instance or the application component ID of a DB connection.");
        }
        $str = microtime(true);
        if (($session = Yii::$app->session) !== null) {
            $str .= $session->id;
        }
        $this->_idLog = time() . ':' . md5($str);
    }

    /**
     * Generates the context information to be logged.
     * The default implementation will dump user information, system variables, etc.
     * @return mixed the context information. If an empty string, it means no context information.
     */
    protected function getContextMessage()
    {
        $context = [];
        if (($user = Yii::$app->getComponent('user', false)) !== null) {
            /** @var \yii\web\User $user */
            $context['user'] = $user->getId();
        }

        foreach ($this->logVars as $name) {
            if (!empty($GLOBALS[$name])) {
                $context[$name] = $GLOBALS[$name];
            }
        }

        return empty($context) ? '' : $context;
    }

    public function export()
    {
        try {
            $collection = $this->db->getCollection($this->logCollection);

            foreach ($this->messages as $message) {
                $collection->insert([
                    'log_id' => $this->_idLog,
                    'level' => $message[1],
                    'category' => $message[2],
                    'log_time' => $message[3],
                    'message' => $message[0],
                ]);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}
