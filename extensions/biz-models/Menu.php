<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property string $menu_name
 * @property string $menu_parent
 * @property string $menu_route
 *
 * @property Menu $menuParent
 * @property Menu[] $menus
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_name'], 'required'],
            [['menu_name', 'menu_parent'], 'string', 'max' => 64],
            [['menu_route'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_name' => 'Menu Name',
            'menu_parent' => 'Menu Parent',
            'menu_route' => 'Menu Route',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuParent()
    {
        return $this->hasOne(Menu::className(), ['menu_name' => 'menu_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['menu_parent' => 'menu_name']);
    }
}