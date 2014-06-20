<?php
namespace biz\tools;
/**
 * Description of AccessModelRule
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class AccessModelRule extends \yii\rbac\Rule
{
    public function execute($user, $item, $params)
    {
        $action = $item->itemName;
        $model = $params[0];
        
    }

}