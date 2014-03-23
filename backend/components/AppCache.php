<?php

namespace backend\components;

use \Yii;
use yii\web\View;

/**
 * Description of AppCache
 *
 * @author MDMunir
 */
class AppCache extends \yii\base\Behavior
{

	public $manifest_file;
	public $template_file;

	public function init()
	{
		if ($this->manifest_file === null) {
			throw new \yii\base\InvalidConfigException(self::className() . '::manifest_file harus diisi');
		}
		if ($this->template_file === null) {
			$this->template_file = __DIR__ . '/_manifest.php';
		}
		parent::init();
	}

	public function events()
	{
		return [
			View::EVENT_END_PAGE => 'createManifest',
			View::EVENT_END_BODY => 'swapCache',
		];
	}

	public function swapCache($event)
	{
		$js = "
if (window.applicationCache) {
	window.applicationCache.addEventListener('updateready', function(e) {
		if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
			window.applicationCache.swapCache();
			window.location.reload();
		}
	}, false);
}
";
		$event->sender->registerJs($js, View::POS_BEGIN);
	}

	public function createManifest($event)
	{
		try {
			$cache = Yii::$app->cache;
			if ($cache === null or $cache->get($this->manifest_file) === false) {
				$view = $event->sender;
				$html = '<html>';
				foreach ($view->jsFiles as $jsFiles) {
					$html.="\n" . implode("\n", $jsFiles);
				}
				$html.="\n" . implode("\n", $view->cssFiles);
				$html.="\n</html>";

				$caches = [];
				$dom = new \DOMDocument();
				$dom->loadHTML($html);
				foreach ($dom->getElementsByTagName('script') as $script) {
					$caches[] = $script->getAttribute('src');
				}
				foreach ($dom->getElementsByTagName('link') as $style) {
					$caches[] = $style->getAttribute('href');
				}
				$manifest = $view->renderFile($this->template_file, ['caches' => $caches]);
				file_put_contents(Yii::getAlias('@webroot/' . $this->manifest_file), $manifest);

				if ($cache !== null) {
					$cache->set($this->manifest_file, [
						'template_file' => $this->template_file,
						'caches' => $caches,
					]);
				}
			}
		} catch (Exception $exc) {
			
		}
	}

	public static function forceUpdateManifest($manifest_file)
	{
		if (($cache = Yii::$app->cache) && ($data = $cache->get($manifest_file)) !== false) {
			$manifest = Yii::$app->getView()->renderFile($data['template_file'], ['caches' => $data['caches']]);
			file_put_contents(Yii::getAlias('@webroot/' . $manifest_file), $manifest);
			return $manifest;
		}
		return 'Gak ada gan....';
	}

}