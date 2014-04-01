<?php

namespace backend\components;

use Yii;

/**
 * Description of ManifestAction
 *
 * @author MDMunir
 */
class ManifestAction extends \yii\base\Action
{

	public function run($id, $forceUpdate = false)
	{
		$keyCache = [AppCache::CACHE_KEY, $id];
		if (($cache = Yii::$app->cache) && ($data = $cache->get($keyCache)) !== false) {
			$key = [AppCache::CACHE_KEY, $id];
			$key[] = !empty($data['uniqueForClient']) && isset(Yii::$app->clientUniqueid) ? Yii::$app->clientUniqueid : false;
			$key[] = !empty($data['uniqueForUser']) ? Yii::$app->user->getId() : false;

			$time = $forceUpdate === false ? $cache->get($key) : false;
			if ($time === false) {
				$time = date('Y-m-d H:i:s');
				$cache->set($key, $time);
			}
			$headers = Yii::$app->response->headers->set('Content-Type', 'text/cache-manifest');

			$manifest = Yii::$app->getView()->renderFile($data['template_file'], [
				'caches' => $data['caches'],
				'time' => $time]);

			return $manifest;
		}
		return '';
	}

}
