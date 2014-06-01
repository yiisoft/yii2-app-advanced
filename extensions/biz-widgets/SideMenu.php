<?php

namespace biz\widgets;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Description of SideMenu
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class SideMenu extends \yii\base\Widget
{
    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: boolean, optional, whether the item should be on active state or not.
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     */
    public $items = [];

    /**
     * @var boolean whether the nav items labels should be HTML-encoded.
     */
    public $encodeLabels = true;

    /**
     * @var boolean whether to automatically activate items according to whether their route setting
     * matches the currently requested route.
     * @see isItemActive
     */
    public $activateItems = true;

    /**
     * @var boolean whether to activate parent menu items when one of the corresponding child menu items is active.
     */
    public $activateParents = false;

    /**
     * @var string the route used to determine if a menu item is active or not.
     * If not set, it will use the route of the current request.
     * @see params
     * @see isItemActive
     */
    public $route;

    /**
     * @var array the parameters used to determine if a menu item is active or not.
     * If not set, it will use `$_GET`.
     * @see route
     * @see isItemActive
     */
    public $params;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        Html::addCssClass($this->options, 'sidebar-menu');
        echo Html::tag('ul', implode("\n", $this->renderItems($this->items)), $this->options);
    }

    public function renderItems($items)
    {
        $result = [];
        foreach ($items as $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            $result[] = $this->renderItem($item);
        }
        return $result;
    }

    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $label = $this->encodeLabels ? Html::encode($item['label']) : $item['label'];
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        $icon1 = ArrayHelper::getValue($item, 'icon1');
        $icon2 = ArrayHelper::getValue($item, 'icon2');
        $badge = ArrayHelper::getValue($item, 'badge');

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }
        $linkContent = '';
        if ($icon1) {
            $linkContent .= Html::tag('i', '', ['class' => 'fa ' . $icon1]);
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }
        if ($items !== null && is_array($items)) {
            Html::addCssClass($options, 'treeview');
            if ($this->activateItems) {
                $items = $this->isChildActive($items, $active);
            }
            $items = Html::tag('ul', implode("\n", $this->renderItems($items)), ['class' => 'treeview-menu']);

            $linkContent .= Html::tag('span', $label);
        } else {
            $linkContent .= $label;
        }
        if ($badge !== null) {
            $badge = (array) $badge;
            $bagdeCss = 'badge pull-right';
            if (isset($badge[1])) {
                $bagdeCss .= ' bg-' . $badge[1];
            }
            $linkContent .= Html::tag('small', $badge[0], ['class' => $bagdeCss]);
        }
        if ($icon2) {
            $linkContent .= Html::tag('i', '', ['class' => 'fa ' . $icon2 . ' pull-right']);
        }
        return Html::tag('li', Html::a($linkContent, $url, $linkOptions) . $items, $options);
    }

    /**
     * Check to see if a child item is active optionally activating the parent.
     * @param array $items @see items
     * @param boolean $active should the parent be active too
     * @return array @see items
     */
    protected function isChildActive($items, &$active)
    {
        foreach ($items as $i => $child) {
            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
                Html::addCssClass($items[$i]['options'], 'active');
                if ($this->activateParents) {
                    $active = true;
                }
            }
        }
        return $items;
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this->route) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                foreach (array_splice($item['url'], 1) as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }
}