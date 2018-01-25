<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "clinics".
 *
 * @property integer $id
 * @property string $name
 * @property integer $hospital_id
 *
 * @property Hospitals $hospital
 * @property Patients[] $patients
 */
class Clinics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clinics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'hospital_id'], 'required'],
            [['hospital_id'], 'integer'],
            [['name'], 'string', 'max' => 15],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospitals::className(), 'targetAttribute' => ['hospital_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Clinic Name',
            'hospital_id' => 'Hospital ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospital()
    {
        return $this->hasOne(Hospitals::className(), ['id' => 'hospital_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatients()
    {
        return $this->hasMany(Patients::className(), ['clinic_number_id' => 'id']);
    }
}
