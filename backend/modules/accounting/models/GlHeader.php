<?php

namespace backend\modules\accounting\models;

/**
 * This is the model class for table "gl_header".
 *
 * @property integer $id_gl_header
 * @property string $gl_date
 * @property string $gl_memo
 * @property integer $ref_type
 * @property integer $ref_id
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property GlDetail[] $glDetails
 */
class GlHeader extends \yii\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'gl_header';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['gl_date',], 'required'],
			[['gl_date',], 'string'],
			[['ref_type', 'ref_id',], 'integer'],
			[['gl_memo'], 'string', 'max' => 128]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_gl_header' => 'Id Gl Header',
			'gl_date' => 'Gl Date',
			'gl_memo' => 'Gl Memo',
			'ref_type' => 'Ref Type',
			'ref_id' => 'Ref ID',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGlDetails()
	{
		return $this->hasMany(GlDetail::className(), ['id_gl_header' => 'id_gl_header']);
	}

	public static function createDocument($header, $details, $in_transaction = false)
	{
		if ($in_transaction) {
			$transaction = \Yii::$app->db->beginTransaction();
		}
		try {
			$hdr = new self();
			$hdr->load($header, '');
			if (!$hdr->gl_date) {
				$hdr->gl_date = new \yii\db\Expression('NOW()');
			}
			$err = [];
			$success = $hdr->save();
			if ($success) {
				$total = 0.0;
				$id_header = $hdr->id_gl_header;
				foreach ($details as $detail) {
					$dtl = new GlDetail();
					$coa = Coa::find($detail['id_coa']);
					if ($coa->normal_position == Coa::POSITION_DEBET) {
						$amount = $detail['amount'];
					} else {
						$amount = -$detail['amount'];
					}
					$total += $amount;
					$dtl->id_gl_header = $id_header;
					$dtl->id_coa = $detail['id_coa'];
					$dtl->amount = $amount;
					$success = $success && $dtl->save();
					if (!$success) {
						$err = array_merge($err, $dtl->firstErrors);
						break;
					}
				}
				if($success && $total != 0.0){
					$err[] = 'Not balance...';
					$success = false;
				}
			}
			if ($success) {
				if ($in_transaction) {
					$transaction->commit();
				}
				return true;
			} else {
				throw new \yii\base\UserException(implode("\n", $err));
			}
		} catch (\Exception $exc) {
			if ($in_transaction) {
				$transaction->rollback();
				return false;
			} else {
				throw $exc;
			}
		}
	}

	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => 'backend\components\AutoTimestamp',
			],
			'changeUser' => [
				'class' => 'backend\components\AutoUser',
			]
		];
	}

}
