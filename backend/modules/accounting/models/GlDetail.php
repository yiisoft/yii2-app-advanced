<?php

namespace backend\modules\accounting\models;

/**
 * This is the model class for table "gl_detail".
 *
 * @property integer $id_gl_detail
 * @property integer $id_gl_header
 * @property integer $id_coa
 * @property string $amount
 *
 * @property Coa $idCoa
 * @property GlHeader $idGlHeader
 */
class GlDetail extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'gl_detail';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_gl_header', 'id_coa', 'amount'], 'required'],
			[['id_gl_header', 'id_coa'], 'integer'],
			[['amount'], 'number']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_gl_detail' => 'Id Gl Detail',
			'id_gl_header' => 'Id Gl Header',
			'id_coa' => 'Id Coa',
			'amount' => 'Amount',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdCoa()
	{
		return $this->hasOne(Coa::className(), ['id_coa' => 'id_coa']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdGlHeader()
	{
		return $this->hasOne(GlHeader::className(), ['id_gl_header' => 'id_gl_header']);
	}
}
