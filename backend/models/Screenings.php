<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "screenings".
 *
 * @property integer $id
 * @property string $date_created
 * @property integer $created_by
 * @property string $notes
 *
 * @property PatientScreenings[] $patientScreenings
 * @property Patients[] $patients
 * @property User $createdBy
 */
class Screenings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'screenings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_created', 'created_by'], 'required'],
            [['date_created'], 'safe'],
            [['created_by'], 'integer'],
            [['notes'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'notes' => 'Notes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientScreenings()
    {
        return $this->hasMany(PatientScreenings::className(), ['screening_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatients()
    {
        return $this->hasMany(Patients::className(), ['id' => 'patient_id'])->viaTable('patient_screenings', ['screening_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
