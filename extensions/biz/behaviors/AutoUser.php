<?php

namespace biz\behaviors;

use yii\db\ActiveRecord;

/**
 * Description of AutoUser
 *
 * @author MDMunir
 */
class AutoUser extends \yii\behaviors\BlameableBehavior
{

    /**
     * @var array list of attributes that are to be automatically filled with timestamps.
     * The array keys are the ActiveRecord events upon which the attributes are to be filled with timestamps,
     * and the array values are the corresponding attribute(s) to be updated. You can use a string to represent
     * a single attribute, or an array to represent a list of attributes.
     * The default setting is to update the `created_at` attribute upon AR insertion,
     * and update the `updated_at` attribute upon AR updating.
     */
    public $attributes = [
        ActiveRecord::EVENT_BEFORE_INSERT => ['create_by', 'update_by'],
        ActiveRecord::EVENT_BEFORE_UPDATE => ['update_by'],
    ];

}
