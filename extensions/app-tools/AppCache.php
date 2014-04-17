<?php

namespace app\tools;

use \Yii;
use yii\web\View;
use yii\helpers\Url;

/**
 * Description of AppCache
 *
 * @author MDMunir
 */
class AppCache extends \yii\base\Behavior
{

    const CACHE_KEY = 'manifest';

    public $id;
    public $template_file;
    public $route = '/site/manifest';
    public $extra_caches = [];
    public $uniqueForClient = true;
    public $uniqueForUser = true;

    public function init()
    {
        if ($this->id === null) {
            throw new \yii\base\InvalidConfigException(self::className() . '::idharus diisi');
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
	window.applicationCache.update();
	window.applicationCache.addEventListener('updateready', function(e) {
		if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
			window.applicationCache.swapCache();
			//window.location.reload();
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
            $key = [self::CACHE_KEY, $this->id];
            if ($cache === null or $cache->get($key) === false or true) {
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
                $caches = array_merge($caches, $this->extra_caches);

                if ($cache !== null) {
                    $cache->set($key, [
                        'template_file' => $this->template_file,
                        'caches' => $caches,
                        'uniqueForClient' => $this->uniqueForClient,
                        'uniqueForUser' => $this->uniqueForUser,
                    ]);
                }
            }
        } catch (Exception $exc) {
            
        }
    }

    public function getManifestFile()
    {
        return Url::toRoute([$this->route, 'id' => $this->id], true);
    }

}
