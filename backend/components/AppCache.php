<?php

namespace backend\components;

use \Yii;

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
			$this->template_file = Yii::$app->getLayoutPath() . DIRECTORY_SEPARATOR . '_manifest.php';
		}
		parent::init();
	}

	public function events()
	{
		return [
			\yii\web\View::EVENT_END_PAGE => 'createManifest',
		];
	}

	public function createManifest($event)
	{
		try {
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
		} catch (Exception $exc) {
			
		}
	}

}