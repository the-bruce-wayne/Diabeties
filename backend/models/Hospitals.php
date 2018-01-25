<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hospitals".
 *
 * @property integer $id
 * @property string $hospital_name
 * @property string $address
 *
 * @property Clinics[] $clinics
 * @property Patients[] $patients
 */
class Hospitals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hospitals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hospital_name', 'address'], 'required'],
            [['hospital_name'], 'string', 'max' => 15],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospital_name' => 'Hospital Name',
            'address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinics()
    {
        return $this->hasMany(Clinics::className(), ['hospital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatients()
    {
        return $this->hasMany(Patients::className(), ['hospital_id' => 'id']);
    }
}
