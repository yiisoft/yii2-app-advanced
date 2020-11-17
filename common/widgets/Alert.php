<?php
namespace common\widgets;

use Yii;
use yii\bootstrap4\Widget;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Alert extends Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - key: the name of the session flash variable
     * - value: the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        'success' => [
            'class' => 'alert-success',
            'icon' => 'fa-check'
        ],
        'info' => [
            'class' => 'alert-info',
            'icon' => 'fa-info'
        ],
        'warning' => [
            'class' => 'alert-warning',
            'icon' => 'fa-exclamation-triangle'
        ],
        'error' => [
            'class' => 'alert-danger',
            'icon' => 'fa-ban'
        ],
        'danger' => [
            'class' => 'alert-danger',
            'icon' => 'fa-ban'
        ],
        'light' => [
            'class' => 'alert-light',
        ],
        'dark' => [
            'class' => 'alert-dark'
        ],
        'custom' => [
            'class' => 'alert-dark',
            'icon' => 'fa-brain',
            'title' => 'Hi! I\'m a custom Alert'
        ]
    ];
    /**
     * @var array the options for rendering the close button tag.
     * Array will be passed to [[\yii\bootstrap\Alert::closeButton]].
     */
    public $closeButton = [];


    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();

        foreach ($flashes as $type => $flash) {
            $params = $this->alertTypes[$type];

            if (!isset($this->alertTypes[$type])) {
                continue;
            }

            foreach ((array) $flash as $i => $message) {
                echo \hail812\adminlte3\widgets\Alert::widget([
                    'body' => $message,
                    'type' => $type,
                    'title' => $params['title'] ?? 'Alert',
                    'simple' => $params['no_head'] ?? false,
                    'icon' => $params['icon'],
                    'alertTypes' => $this->alertTypes,
                    'closeButton' => $this->closeButton
                ]);
            }

            $session->removeFlash($type);
        }
    }
}
