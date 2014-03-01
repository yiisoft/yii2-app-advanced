<?php

namespace backend\models;

/**
 * Description of CheckReload
 *
 * @author MDMunir
 */
class CheckReload extends \yii\base\Behavior
{

	public function events()
	{
		return[
			\yii\base\Model::EVENT_BEFORE_VALIDATE => 'myBeforeValidate'
		];
	}

	/**
	 * 
	 * @param \yii\base\ModelEvent $event
	 */
	public function myBeforeValidate($event)
	{
		$request = \Yii::$app->request;
		$csrf = $request->getBodyParam($request->csrfVar);
		if ($csrf !== null) {
			$csrf = md5($csrf . \Yii::$app->user->id);
			$sql = "select count(*) from tbl_request_csrf where nilai=:nilai";
			if(\Yii::$app->db->createCommand($sql, [':nilai'=>$csrf])->queryScalar() == 0){
				\Yii::$app->db->createCommand()->insert('tbl_request_csrf', ['nilai'=>$csrf])->execute();
			}  else {
				$event->isValid = false;
				$event->sender->addError('','do not reload');
			}
			
		}
	}

}