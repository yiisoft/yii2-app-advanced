<?php

namespace app\tools;

use yii\web\Application;
use yii\web\Cookie;
use Yii;

/**
 * Description of ClientKey
 *
 * @author MDMunir
 */
class ClientKey extends \yii\base\Behavior
{

    const COOKIE_KEY = '_client_uniqueid';
    const CACHE_KEY = 'client_properties';

    public $clientUniqueid;

    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'beforeRequest',
        ];
    }

    public function beforeRequest($event)
    {
        $cookie = Yii::$app->request->cookies->get(self::COOKIE_KEY);
        if ($cookie) {
            $this->clientUniqueid = $cookie->value;
        } else {
            $str = microtime(true);
            if (($session = Yii::$app->session) !== null) {
                $str .= $session->id;
            }
            $this->clientUniqueid = md5($str);
            $cookie = new Cookie();
            $cookie->name = self::COOKIE_KEY;
            $cookie->value = $this->clientUniqueid;
        }
        $cookie->expire = time() + 365 * 24 * 3600;
        Yii::$app->response->cookies->add($cookie);
    }

    public function setClientProperties($key, $value)
    {
        if ($this->clientUniqueid === null) {
            throw new \yii\base\UserException('Sabar gan....');
        }
        if (($cache = Yii::$app->cache) !== null) {
            $cache->set([self::CACHE_KEY, $this->clientUniqueid, $key], $value);
        }
    }

    public function getClientProperties($key)
    {
        if ($this->clientUniqueid === null) {
            throw new \yii\base\UserException('Sabar gan....');
        }
        if (($cache = Yii::$app->cache) !== null) {
            return $cache->get([self::CACHE_KEY, $this->clientUniqueid, $key]);
        }
        return false;
    }

}
