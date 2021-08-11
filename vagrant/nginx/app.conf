<?php
namespace codemix\localeurls;

defined('YII2_LOCALEURLS_TEST') || define('YII2_LOCALEURLS_TEST', false);

use Yii;
use yii\base\InvalidConfigException;
use yii\web\Cookie;
use yii\web\UrlManager as BaseUrlManager;
use yii\web\UrlNormalizerRedirectException;

/**
 * This class extends Yii's UrlManager and adds features to detect the language
 * from the URL or from browser settings transparently. It also can persist the
 * language in the user session and optionally in a cookie. It also adds the
 * language parameter to any created URL.
 */
class UrlManager extends BaseUrlManager
{
    const EVENT_LANGUAGE_CHANGED = 'languageChanged';

    /**
     * @var array list of available language codes. More specific patterns
     * should come first, e.g. 'en_us' before 'en'. This can also contain
     * mapping of <url_value> => <language>, e.g. 'english' => 'en'.
     */
    public $languages = [];

    /**
     * @var bool whether to enable locale URL specific features
     */
    public $enableLocaleUrls = true;

    /**
     * @var bool whether the default language should use an URL code like any
     * other configured language.
     *
     * By default this is `false`, so for URLs without a language code the
     * default language is assumed.  In addition any request to an URL that
     * contains the default language code will be redirected to the same URL
     * without a language code. So if the default language is `fr` and a user
     * requests `/fr/some/page` he gets redirected to `/some/page`. This way
     * the persistent language can be reset to the default language.
     *
     * If this is `true`, then an URL that does not contain any language code
     * will be redirected to the same URL with default language code. So if for
     * example the default language is `fr`, then any request to `/some/page`
     * will be redirected to `/fr/some/page`.
     *
     */
    public $enableDefaultLanguageUrlCode = false;

    /**
     * @var bool whether to detect the app language from the HTTP headers (i.e.
     * browser settings).  Default is `true`.
     */
    public $enableLanguageDetection = true;

    /**
     * @var bool whether to store the detected language in session and
     * (optionally) a cookie. If this is `true` (default) and a returning user
     * tries to access any URL without a language prefix, he'll be redirected
     * to the respective stored language URL (e.g. /some/page ->
     * /fr/some/page).
     */
    public $enableLanguagePersistence = true;

    /**
     * @var bool whether to keep upper case language codes in URL. Default is
     * `false` wich will e.g.  redirect `de-AT` to `de-at`.
     */
    public $keepUppercaseLanguageCode = false;

    /**
     * @var string the name of the session key that is used to store the
     * language. Default is '_language'.
     */
    public $languageSessionKey = '_language';

    /**
     * @var string the name of the language cookie. Default is '_language'.
     */
    public $languageCookieName = '_language';

    /**
     * @var int number of seconds how long the language information should be
     * stored in cookie, if `$enableLanguagePersistence` is true. Set to
     * `false` to disable the language cookie completely.  Default is 30 days.
     */
    public $languageCookieDuration = 2592000;

    /**
     * @var array configuration options for the language cookie. Note that
     * `$languageCookieName` and `$languageCookeDuration` will override any
     * `name` and `expire` settings provided here.
     */
    public $languageCookieOptions = [];

    /**
     * @var array list of route and URL regex patterns to ignore during
     * language processing. The keys of the array are patterns for routes, the
     * values are patterns for URLs. Route patterns are checked during URL
     * creation. If a pattern matches, no language parameter will be added to
     * the created URL.  URL patterns are checked during processing incoming
     * requests. If a pattern matches, the language processing will be skipped
     * for that URL. Examples:
     *
     * ~~~php
     * [
     *     '#^site/(login|register)#' => '#^(login|register)#'
     *     '#^api/#' => '#^api/#',
     * ]
     * ~~~
     */
    public $ignoreLanguageUrlPatterns = [];

    /**
     * @var string the language that was initially set in the application
     * configuration
     */
    protected $_defaultLanguage;

    /**
     * @inheritdoc
     */
    public $enablePrettyUrl = true;

    /**
     * @var string if a parameter with this name is passed to any `createUrl()`
     * method, the created URL will use the language specified there. URLs
     * created this way can be used to switch to a different language. If no
     * such parameter is used, the currently detected application language is
     * used.
     */
    public $languageParam = 'language';

    /**
     * @var \yii\web\Request
     */
    protected $_request;

    /**
     * @var bool whether locale URL was processed
     */
    protected $_processed = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->enableLocaleUrls && $this->languages) {
            if (!$this->enablePrettyUrl) {
                throw new InvalidConfigException('Locale URL support requires enablePrettyUrl to be set to true.');
            }
        }
        $this->_defaultLanguage = Yii::$app->language;
        parent::init();
    }

    /**
     * @return string the `language` option that was initially set in the
     * application config file, before it was modified by this component.
     */
    public function getDefaultLanguage()
    {
        return $this->_defaultLanguage;
    }

    /**
     * @inheritdoc
     */
    public function parseRequest($request)
    {
        if (!Yii::$app->request->isPost && $this->enableLocaleUrls && $this->languages) {
            $this->_request = $request;
            $process = true;
            if ($this->ignoreLanguageUrlPatterns) {
                $pathInfo = $request->getPathInfo();
                foreach ($this->ignoreLanguageUrlPatterns as $k => $pattern) {
                    if (preg_match($pattern, $pathInfo)) {
                        $message = "Ignore pattern '$pattern' matches '$pathInfo.' Skipping language processing.";
                        Yii::trace($message, __METHOD__);
                        $process = false;
                    }
                }
            }
            if ($process && !$this->_processed) {
                // Check if a normalizer wants to redirect
                $normalized = false;
                if (property_exists($this, 'normalizer') && $this->normalizer!==false) {
                    try {
                        parent::parseRequest($request);
                    } catch (UrlNormalizerRedirectException $e) {
                        $normalized = true;
                    }
                }
                $this->_processed = true;
                $this->processLocaleUrl($normalized);
            }
        }
        return parent::parseRequest($request);
    }

    /**
     * @inheritdoc
     */
    public function createUrl($params)
    {
        if ($this->ignoreLanguageUrlPatterns) {
            $params = (array) $params;
            $route = trim($params[0], '/');
            foreach ($this->ignoreLanguageUrlPatterns as $pattern => $v) {
                if (preg_match($pattern, $route)) {
                    return parent::createUrl($params);
                }
            }
        }

        if ($this->enableLocaleUrls && $this->languages) {
            $params = (array) $params;

            $isLanguageGiven = isset($params[$this->languageParam]);
            $language = $isLanguageGiven ? $params[$this->languageParam] : Yii::$app->language;
            $isDefaultLanguage = $language===$this->getDefaultLanguage();

            if ($isLanguageGiven) {
                unset($params[$this->languageParam]);
            }

            $url = parent::createUrl($params);

            if (
                // Only add language if it's not empty and ...
                $language!=='' && (

                    // ... it's not the default language or default language uses URL code ...
                    !$isDefaultLanguage || $this->enableDefaultLanguageUrlCode ||

                    // ... or if a language is explicitely given, but only if
                    // either persistence or detection is enabled.  This way a
                    // "reset URL" can be created for the default language.
                    $isLanguageGiven && ($this->enableLanguagePersistence || $this->enableLanguageDetection)
                )
            ) {

                $key = array_search($language, $this->languages);

                if (is_string($key)) {
                    $language = $key;
                }

                if (!$this->keepUppercaseLanguageCode) {
                    $language = strtolower($language);
                }

                // Calculate the position where the language code has to be inserted
                // depending on the showScriptName and baseUrl configuration:
                //
                //  - /foo/bar -> /de/foo/bar
                //  - /base/foo/bar -> /base/de/foo/bar
                //  - /index.php/foo/bar -> /index.php/de/foo/bar
                //  - /base/index.php/foo/bar -> /base/index.php/de/foo/bar
                //
                $prefix = $this->showScriptName ? $this->getScriptUrl() : $this->getBaseUrl();
                $insertPos = strlen($prefix);

                // Remove any trailing slashes for root URLs
                if ($this->suffix !== '/') {
                    if (count($params) === 1 ) {
                        // / -> ''
                        // /base/ -> /base
                        // /index.php/ -> /index.php
                        // /base/index.php/ -> /base/index.php
                        if ($url === $prefix . '/') {
                            $url = rtrim($url, '/');
                        }
                    } elseif (strncmp($url, $prefix . '/?', $insertPos + 2) === 0) {
                        // /?x=y -> ?x=y
                        // /base/?x=y -> /base?x=y
                        // /index.php/?x=y -> /index.php?x=y
                        // /base/index.php/?x=y -> /base/index.php?x=y
                        $url = substr_replace($url, '', $insertPos, 1);
                    }
                }

                // If we have an absolute URL the length of the host URL has to
                // be added:
                //
                //  - http://www.example.com
                //  - http://www.example.com?x=y
                //  - http://www.example.com/foo/bar
                //
                if (strpos($url, '://')!==false) {
                    // Host URL ends at first '/' or '?' after the schema
                    if (($pos = strpos($url, '/', 8))!==false || ($pos = strpos($url, '?', 8))!==false) {
                        $insertPos += $pos;
                    } else {
                        $insertPos += strlen($url);
                    }
                }
                if ($insertPos > 0) {
                    return substr_replace($url, '/' . $language, $insertPos, 0);
                } else {
                    return '/' . $language . $url;
                }

            } else {
                return $url;
            }
        } else {
            return parent::createUrl($params);
        }
    }

    /**
     * Checks for a language or locale parameter in the URL and rewrites the
     * pathInfo if found.  If no parameter is found it will try to detect the
     * language from persistent storage (session / cookie) or from browser
     * settings.
     *
     * @param bool $normalized whether a UrlNormalizer tried to redirect
     */
    protected function processLocaleUrl($normalized)
    {
        $pathInfo = $this->_request->getPathInfo();
        $parts = [];
        foreach ($this->languages as $k => $v) {
            $value = is_string($k) ? $k : $v;
            if (substr($value, -2)==='-*') {
                $lng = substr($value, 0, -2);
                $parts[] = "$lng\-[a-z]{2,3}";
                $parts[] = $lng;
            } else {
                $parts[] = $value;
            }
        }
        $pattern = implode('|', $parts);
        if (preg_match("#^($pattern)(/?)\b#i", $pathInfo, $m)) {
            $this->_request->setPathInfo(mb_substr($pathInfo, mb_strlen($m[1].$m[2])));
            $code = $m[1];
            if (isset($this->languages[$code])) {
                // Replace alias with language code
                $language = $this->languages[$code];
            } else {
                // lowercase language, uppercase country
                list($language,$country) = $this->matchCode($code);
                if ($country!==null) {
                    if ($code==="$language-$country" && !$this->keepUppercaseLanguageCode) {
                        $this->redirectToLanguage(strtolower($code));   // Redirect ll-CC to ll-cc
                    } else {
                        $language = "$language-$country";
                    }
                }
                if ($language===null) {
                    $language = $code;
                }
            }
            Yii::$app->language = $language;
            Yii::trace("Language code found in URL. Setting application language to '$language'.", __METHOD__);
            if ($this->enableLanguagePersistence) {
                $this->persistLanguage($language);
            }

            // "Reset" case: We called e.g. /fr/demo/page so the persisted language was set back to "fr".
            // Now we can redirect to the URL without language prefix, if default prefixes are disabled.
            $reset = !$this->enableDefaultLanguageUrlCode && $language===$this->_defaultLanguage;

            if ($reset || $normalized) {
                $this->redirectToLanguage('');
            }
        } else {
            $language = null;
            if ($this->enableLanguagePersistence) {
                $language = $this->loadPersistedLanguage();
            }
            if ($language===null && $this->enableLanguageDetection) {
                foreach ($this->_request->getAcceptableLanguages() as $acceptable) {
                    list($language,$country) = $this->matchCode($acceptable);
                    if ($language!==null) {
                        $language = $country===null ? $language : "$language-$country";
                        Yii::trace("Detected browser language '$language'.", __METHOD__);
                        break;
                    }
                }
            }
            if ($language===null || $language===$this->_defaultLanguage) {
                if (!$this->enableDefaultLanguageUrlCode) {
                    return;
                } else {
                    $language = $this->_defaultLanguage;
                }
            }
            // #35: Only redirect if a valid language was found
            if ($this->matchCode($language)===[null, null]) {
                return;
            }

            $key = array_search($language, $this->languages);
            if ($key && is_string($key)) {
                $language = $key;
            }
            if (!$this->keepUppercaseLanguageCode) {
                $language = strtolower($language);
            }
            $this->redirectToLanguage($language);
        }
    }

    /**
     * @param string $language the language code to persist in session and cookie
     */
    protected function persistLanguage($language)
    {
        if ($this->hasEventHandlers(self::EVENT_LANGUAGE_CHANGED)) {
            $oldLanguage = $this->loadPersistedLanguage();
            if ($oldLanguage !== $language) {
                Yii::trace("Triggering languageChanged event: $oldLanguage -> $language", __METHOD__);
                $this->trigger(self::EVENT_LANGUAGE_CHANGED, new LanguageChangedEvent([
                    'oldLanguage' => $oldLanguage,
                    'language' => $language,
                ]));
            }
        }
        Yii::$app->session[$this->languageSessionKey] = $language;
        Yii::trace("Persisting language '$language' in session.", __METHOD__);
        if ($this->languageCookieDuration) {
            $cookie = new Cookie(array_merge(
                ['httpOnly' => true],
                $this->languageCookieOptions,
                [
                    'name' => $this->languageCookieName,
                    'value' => $language,
                    'expire' => time() + (int) $this->languageCookieDuration,
                ]
            ));
            Yii::$app->getResponse()->getCookies()->add($cookie);
            Yii::trace("Persisting language '$language' in cookie.", __METHOD__);
        }
    }

    /**
     * @return string|null the persisted language code or null if none found
     */
    protected function loadPersistedLanguage()
    {
        $language = Yii::$app->session->get($this->languageSessionKey);
        $language!==null && Yii::trace("Found persisted language '$language' in session.", __METHOD__);
        if ($language===null) {
            $language = $this->_request->getCookies()->getValue($this->languageCookieName);
            $language!==null && Yii::trace("Found persisted language '$language' in cookie.", __METHOD__);
        }
        return $language;
    }

    /**
     * Tests whether the given code matches any of the configured languages.
     *
     * The return value is an array of the form `[$language, $country]`, where
     * `$country` or both can be `null`.
     *
     * If the code is a single language code, and matches either
     *
     *  - an exact language as configured (ll)
     *  - a language with a country wildcard (ll-*)
     *
     * the code value will be returned as `$language`.
     *
     * If the code is of the form `ll-CC`, and matches either
     *
     *  - an exact language/country code as configured (ll-CC)
     *  - a language with a country wildcard (ll-*)
     *
     * `$country` well be set to the `CC` part of the configured language.
     * If only the language part matches a configured language, only `$language`
     * will be set to that language.
     *
     * @param string $code the code to match
     * @return array of `[$language, $country]` where `$country` or both can be
     * `null`
     */
    protected function matchCode($code)
    {
        $hasDash = strpos($code, '-') !== false;
        $lcCode = strtolower($code);
        $lcLanguages = array_map('strtolower', $this->languages);

        if (($key = array_search($lcCode, $lcLanguages)) === false) {
            if ($hasDash) {
                list($language, $country) = explode('-', $code, 2);
            } else {
                $language = $code;
                $country = null;
            }
            if (in_array($language . '-*', $this->languages)) {
                if ($hasDash) {
                    // TODO: Make wildcards work with script codes
                    // like `sr-Latn`
                    return [$language, strtoupper($country)];
                } else {
                    return [$language, null];
                }
            } elseif ($hasDash && in_array($language, $this->languages)) {
                return [$language, null];
            } else {
                return [null, null];
            }
        } else {
            $result = $this->languages[$key];
            return $hasDash ? explode('-', $result, 2) : [$result, null];
        }

        $language = $code;
        $country = null;
        $parts = explode('-', $code);
        if (count($parts)===2) {
            $language = $parts[0];
            $country = strtoupper($parts[1]);
        }

        if (in_array($code, $this->languages)) {
            return [$language, $country];
        } elseif (
            $country && in_array("$language-$country", $this->languages) ||
            in_array("$language-*", $this->languages)
        ) {
            return [$language, $country];
        } elseif (in_array($language, $this->languages)) {
            return [$language, null];
        } else {
            return [null, null];
        }
    }

    /**
     * Redirect to the current URL with given language code applied
     *
     * @param string $language the language code to add. Can also be empty to
     * not add any language code.
     * @throws \yii\base\Exception
     * @throws \yii\web\NotFoundHttpException
     */
    protected function redirectToLanguage($language)
    {
        try {
            $result = parent::parseRequest($this->_request);
        } catch (UrlNormalizerRedirectException $e) {
            if (is_array($e->url)) {
                $params = $e->url;
                $route = array_shift($params);
                $result = [$route, $params];
            } else {
                $result = [$e->url, []];
            }
        }
        if ($result === false) {
            throw new \yii\web\NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
        list ($route, $params) = $result;
        if($language){
            $params[$this->languageParam] = $language;
        }
        // See Yii Issues #8291 and #9161:
        $params = $params + $this->_request->getQueryParams();
        array_unshift($params, $route);
        $url = $this->createUrl($params);
        // Required to prevent double slashes on generated URLs
        if ($this->suffix==='/' && $route==='' && count($params)===1) {
            $url = rtrim($url, '/').'/';
        }
        // Prevent redirects to same URL which could happen in certain
        // UrlNormalizer / custom rule combinations
        if ($url === $this->_request->url) {
            return;
        }
        Yii::trace("Redirecting to $url.", __METHOD__);
        Yii::$app->getResponse()->redirect($url);
        if (YII2_LOCALEURLS_TEST) {
            // Response::redirect($url) above will call `Url::to()` internally.
            // So to really test for the same final redirect URL here, we need
            // to call Url::to(), too.
            throw new \yii\base\Exception(\yii\helpers\Url::to($url));
        } else {
            Yii::$app->end();
        }
    }
}
